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

class SpecialtiesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexSpecialty $request
     * @return array|Factory|View
     */
    public function index(IndexSpecialty $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Specialty::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'name', 'description', 'status', 'user_registration', 'user_modification'],

            // set columns to searchIn
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

        //  $data->status='inactivo';
        //  $id='status';
        //  $user = $data::find($dato->status=$id);

        return view('admin.specialty.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
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
     * Store a newly created resource in storage.
     *
     * @param StoreSpecialty $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreSpecialty $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Specialty
        $specialty = Specialty::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/specialties'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/specialties');
    }

    /**
     * Display the specified resource.
     *
     * @param Specialty $specialty
     * @throws AuthorizationException
     * @return void
     */
    public function show(Specialty $specialty)
    {
        $this->authorize('admin.specialty.show', $specialty);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
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
     * Update the specified resource in storage.
     *
     * @param UpdateSpecialty $request
     * @param Specialty $specialty
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateSpecialty $request, Specialty $specialty)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Specialty
        $specialty->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/specialties'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/specialties');
    }

    /**
     * Remove the specified resource from storage.
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
     * Remove the specified resources from storage.
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

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
