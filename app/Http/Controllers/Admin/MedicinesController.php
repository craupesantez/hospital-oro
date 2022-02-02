<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Medicine\BulkDestroyMedicine;
use App\Http\Requests\Admin\Medicine\DestroyMedicine;
use App\Http\Requests\Admin\Medicine\IndexMedicine;
use App\Http\Requests\Admin\Medicine\StoreMedicine;
use App\Http\Requests\Admin\Medicine\UpdateMedicine;
use App\Models\Medicine;
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

class MedicinesController extends Controller
{

    /**
     * 
     *
     * @param IndexMedicine $request
     * @return array|Factory|View
     */
    public function index(IndexMedicine $request)
    {
        
        $data = AdminListing::create(Medicine::class)->processRequestAndGet(
            
            $request,

            ['id', 'name', 'indications', 'amount', 'measure'],

            ['id', 'name', 'indications', 'measure']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.medicine.index', ['data' => $data]);
    }

    /**
     * 
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.medicine.create');

        return view('admin.medicine.create');
    }

    /**
     * 
     *
     * @param StoreMedicine $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreMedicine $request)
    {
        $sanitized = $request->getSanitized();

        $medicine = Medicine::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/medicines'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/medicines');
    }

    /**
     * 
     *
     * @param Medicine $medicine
     * @throws AuthorizationException
     * @return void
     */
    public function show(Medicine $medicine)
    {
        $this->authorize('admin.medicine.show', $medicine);

    }

    /**
     *
     *
     * @param Medicine $medicine
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Medicine $medicine)
    {
        $this->authorize('admin.medicine.edit', $medicine);


        return view('admin.medicine.edit', [
            'medicine' => $medicine,
        ]);
    }

    /**
     * 
     *
     * @param UpdateMedicine $request
     * @param Medicine $medicine
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateMedicine $request, Medicine $medicine)
    {
        
        $sanitized = $request->getSanitized();

        $medicine->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/medicines'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/medicines');
    }

    /**
     *
     *
     * @param DestroyMedicine $request
     * @param Medicine $medicine
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyMedicine $request, Medicine $medicine)
    {
        $medicine->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * 
     *
     * @param BulkDestroyMedicine $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyMedicine $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Medicine::whereIn('id', $bulkChunk)->delete();

                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
