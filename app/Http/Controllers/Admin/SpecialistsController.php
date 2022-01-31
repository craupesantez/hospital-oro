<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Specialist\BulkDestroySpecialist;
use App\Http\Requests\Admin\Specialist\DestroySpecialist;
use App\Http\Requests\Admin\Specialist\IndexSpecialist;
use App\Http\Requests\Admin\Specialist\StoreSpecialist;
use App\Http\Requests\Admin\Specialist\UpdateSpecialist;
use App\Models\Specialist;
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

class SpecialistsController extends Controller
{

    /**
     * 
     *
     * @param IndexSpecialist $request
     * @return array|Factory|View
     */
    public function index(IndexSpecialist $request)
    {
        $data = AdminListing::create(Specialist::class)->processRequestAndGet(

            $request,

            ['id', 'id_person', 'id_specialities', 'year_of_specialization', 'institution'],

            ['id', 'year_of_specialization', 'institution']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }
        return view('admin.specialist.index', ['data' => $data]);
    }

    /**
     * 
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.specialist.create');

        return view('admin.specialist.create');
    }

    /**
     * 
     *
     * @param StoreSpecialist $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreSpecialist $request)
    {
        $sanitized = $request->getSanitized();

        $specialist = Specialist::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/specialists'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/specialists');
    }

    /**
     * 
     *
     * @param Specialist $specialist
     * @throws AuthorizationException
     * @return void
     */
    public function show(Specialist $specialist)
    {
        $this->authorize('admin.specialist.show', $specialist);

    }

    /**
     * 
     *
     * @param Specialist $specialist
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Specialist $specialist)
    {
        $this->authorize('admin.specialist.edit', $specialist);


        return view('admin.specialist.edit', [
            'specialist' => $specialist,
        ]);
    }

    /**
     * 
     *
     * @param UpdateSpecialist $request
     * @param Specialist $specialist
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateSpecialist $request, Specialist $specialist)
    {
        $sanitized = $request->getSanitized();

        $specialist->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/specialists'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/specialists');
    }

    /**
     * 
     *
     * @param DestroySpecialist $request
     * @param Specialist $specialist
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroySpecialist $request, Specialist $specialist)
    {
        $specialist->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * 
     *
     * @param BulkDestroySpecialist $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroySpecialist $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Specialist::whereIn('id', $bulkChunk)->delete();
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
