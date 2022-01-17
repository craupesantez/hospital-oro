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
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Person::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'firt_name', 'last_name', 'identification', 'email', 'telephone', 'address', 'birthday', 'gender', 'id_cities'],

            // set columns to searchIn
            ['id', 'firt_name', 'last_name', 'identification', 'email', 'telephone', 'address', 'gender']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.person.index', ['data' => $data]);
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
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Person
        $person = Person::create($sanitized);
        // Store the AdminUser
        $userPerson = array(
            "first_name" => $sanitized["firt_name"],
            "last_name" => $sanitized["last_name"],
            "email" => $sanitized["email"],
            "password" =>  Hash::make($sanitized["email"]), //"$2y$10$12GaD.Jn5TH8DhVmWSjxqe59.y3kkW8LpOoEQVGvO.7PjRc3XMWi.",
            "forbidden" => false,
            "language" => "en",
            "activated" => true,
          );
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

        // TODO your code goes here
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
     * Update the specified resource in storage.
     *
     * @param UpdatePerson $request
     * @param Person $person
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdatePerson $request, Person $person)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Person
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
     * Remove the specified resources from storage.
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

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
