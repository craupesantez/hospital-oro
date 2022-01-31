<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Specialty\BulkDestroySpecialty;
use App\Http\Requests\Admin\Specialty\DestroySpecialty;
use App\Http\Requests\Admin\Specialty\IndexSpecialty;
use App\Http\Requests\Admin\Specialty\StoreSpecialty;
use App\Http\Requests\Admin\Specialty\UpdateSpecialty;
use App\Models\Specialty;
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
use Illuminate\Support\Facades\Auth;
use PharIo\Manifest\Email;
use App\Models\Specialist;



class SpecialtiesController extends Controller
{

    /**
     * 
     *
     * @param IndexSpecialty $request
     * @return array|Factory|View
     */
    public function index(IndexSpecialty $request)
    {
        $data = AdminListing::create(Specialty::class)->processRequestAndGet(
            
            $request,

            ['id', 'name', 'description', 'status', 'user_registration', 'user_modification'],

            ['id', 'name', 'description', 'status', 'user_registration', 'user_modification']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.specialty.index', ['data' => $data]);
    }

    /**
     * 
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.specialty.create');

            return view('admin.specialty.create');
    }

    /**
     * 
     *
     * @param StoreSpecialty $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreSpecialty $request)
    {
        // 
        $sanitized = $request->getSanitized();

        $email = Auth::user()->email;
        $specialtyModificado= array(
            "name"=>$sanitized["name"],
            "description"=>$sanitized["description"],
            "status"=>$sanitized["status"],
            "user_registration"=>$email,
            "user_modification"=>$email,
        ) ;
        
        $specialty = Specialty::create($specialtyModificado);

        if ($request->ajax()) {
            return ['redirect' => url('admin/specialties'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/specialties');
    }

    /**
     * 
     *
     * @param Specialty $specialty
     * @throws AuthorizationException
     * @return void
     */
    public function show(Specialty $specialty)
    {
        $this->authorize('admin.specialty.show', $specialty);

    }

    /**
     * 
     *
     * @param Specialty $specialty
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Specialty $specialty)
    {
        $this->authorize('admin.specialty.edit', $specialty);


        return view('admin.specialty.edit', [
            'specialty' => $specialty,
        ]);
    }

    /**
     * 
     *
     * @param UpdateSpecialty $request
     * @param Specialty $specialty
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateSpecialty $request, Specialty $specialty)
    {
        $sanitized = $request->getSanitized();
        $email= Auth::user()->email;
        
        $specialtyModificado= array(
            "name"=>$sanitized["name"],
            "description"=>$sanitized["description"],
            "status"=>$sanitized["status"],
            "user_registration"=>$sanitized["user_registration"],
            "user_modification"=>$email,
        ) ;

        $specialty->update($specialtyModificado);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/specialties'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/specialties');
    }

    /**
     * 
     *
     * @param DestroySpecialty $request
     * @param Specialty $specialty
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroySpecialty $request, Specialty $specialty)
    {
        $specialty->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * 
     *
     * @param BulkDestroySpecialty $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroySpecialty $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Specialty::whereIn('id', $bulkChunk)->delete();

                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }

    public function specialists()
    {
        return $this->belongsToMany(Specialist::class);
    }
}