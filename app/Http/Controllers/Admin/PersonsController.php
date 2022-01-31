<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Person\BulkDestroyPerson;
use App\Http\Requests\Admin\Person\DestroyPerson;
use App\Http\Requests\Admin\Person\IndexPerson;
use App\Http\Requests\Admin\Person\StorePerson;
use App\Http\Requests\Admin\Person\UpdatePerson;
use App\Models\City;
use App\Models\Person;
use Brackets\AdminListing\Facades\AdminListing;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Brackets\AdminAuth\Models\AdminUser;
use Illuminate\Support\Facades\Hash;

class PersonsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexPerson $request
     * @return array|Factory|View
     */
    public function index(IndexPerson $request)
    {
        // crear una instancia de AdminListing para un modelo específico y
        $data = AdminListing::create(Person::class)->processRequestAndGet(
            // pasar la solicitud con parametros
            $request,

            //se especifiica la columna de la query
            ['id', 'firt_name', 'last_name', 'identification', 'email', 'telephone', 'address', 'birthday', 'gender', 'id_cities'],

            //se establece las columnas en las que se puede buscar
            ['id', 'firt_name', 'last_name', 'identification', 'email', 'telephone', 'address', 'gender'],
            function ($query) use ($request) {
                $query->with(['city']);

                // siendo una query se realiza el join entre las tablas a traves de la llave foranea
                $query->join('cities', 'cities.id', '=', 'persons.id_cities');

                if($request->has('cities')){
                    $query->whereIn('id_cities', $request->get('cities'));
                }
            }
        );
         
        $data2= $data->toJson();
        
        $a_persons= json_decode($data2);
        
        foreach($a_persons->data as $person){
            $person->age= $this->ageCalcule($person->birthday);
        }
        
         $data= collect($a_persons);
    
        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id'),
                ];
            }
            return ['data' => $data];
        }
        return view('admin.person.index', ['data' => $data, 'cities' => City::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.person.create');

        return view('admin.person.create', [
            'cities' => City::orderBy('name')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePerson $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StorePerson $request)
    {
        // Sanitize-> de este objeto se obtiene los campos del formulario
        $sanitized = $request->getSanitized();

        // se crea un objeto de tipo de persona(modelo) que tiene el metodo create q almacena los datos 
        $person = Person::create($sanitized);
        // se crea un array de tipo adminUser
        $userPerson = array(
            "first_name" => $sanitized["firt_name"],
            "last_name" => $sanitized["last_name"],
            "email" => $sanitized["email"],
            "password" =>  Hash::make($sanitized["email"]), //"$2y$10$12GaD.Jn5TH8DhVmWSjxqe59.y3kkW8LpOoEQVGvO.7PjRc3XMWi.",
            "forbidden" => false,
            "language" => "en",
            "activated" => true,
          );
          //se crea un objeto de tipo de AdminUser(modelo) que tiene el metodo create q almacena los datos 
        $adminUser = AdminUser::create($userPerson);

        if ($request->ajax()) {
            return ['redirect' => url('admin/people'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/people');
    }

    /**
     * Display the specified resource.
     *
     * @param Person $person
     * @throws AuthorizationException
     * @return void
     */
    public function show(Person $person)
    {
        $this->authorize('admin.person.show', $person);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Person $person
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Person $person)
    {
        $this->authorize('admin.person.edit', $person);


        return view('admin.person.edit', [
            'person' => $person,
            'cities' => City::all()
        ]);
    }

    /**
     * metodo utilizado para actualizar persona
     *
     * @param UpdatePerson $request
     * @param Person $person
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdatePerson $request, Person $person)
    {
        // Sanitize -> de este objeto se obtiene los campos del formulario
        $sanitized = $request->getSanitized();

        // actualiza los valores de persona
        $person->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/people'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/people');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyPerson $request
     * @param Person $person
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyPerson $request, Person $person)
    {
        $person->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Metodo para eliminar el elemento por id
     *
     * @param BulkDestroyPerson $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyPerson $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Person::whereIn('id', $bulkChunk)->delete();

                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
    
    //funcion para calcular la edad del paciente
    public function ageCalcule($date_birth ){

        $date_birth_format= date('Y-m-d',strtotime($date_birth)) ; 
        $current_day = date("Y-m-d");
        $current_age = date_diff(date_create($date_birth_format), date_create($current_day));
        
        return $current_age->format('%y');
    }


}
