<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\City\BulkDestroyCity;
use App\Http\Requests\Admin\City\DestroyCity;
use App\Http\Requests\Admin\City\IndexCity;
use App\Http\Requests\Admin\City\StoreCity;
use App\Http\Requests\Admin\City\UpdateCity;
use App\Models\City;
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

class CitiesController extends Controller
{

    /**
     * 
     *
     * @param IndexCity $request
     * @return array|Factory|View
     */
    public function index(IndexCity $request)
    {
        $data = AdminListing::create(City::class)->processRequestAndGet(
            $request,

            ['id', 'name', 'postal_code'],

            ['id', 'name', 'postal_code']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.city.index', ['data' => $data]);
    }

    /**
     * 
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.city.create');

        return view('admin.city.create');
    }

    /**
     * 
     *
     * @param StoreCity $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreCity $request)
    {
        $sanitized = $request->getSanitized();

        $city = City::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/cities'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/cities');
    }

    /**
     * 
     *
     * @param City $city
     * @throws AuthorizationException
     * @return void
     */
    public function show(City $city)
    {
        $this->authorize('admin.city.show', $city);

    }

    /**
     * 
     *
     * @param City $city
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(City $city)
    {
        $this->authorize('admin.city.edit', $city);


        return view('admin.city.edit', [
            'city' => $city,
        ]);
    }

    /**
     * 
     *
     * @param UpdateCity $request
     * @param City $city
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateCity $request, City $city)
    {
        $sanitized = $request->getSanitized();

        $city->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/cities'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/cities');
    }

    /**
     *
     *
     * @param DestroyCity $request
     * @param City $city
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyCity $request, City $city)
    {
        $city->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     *
     *
     * @param BulkDestroyCity $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyCity $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    City::whereIn('id', $bulkChunk)->delete();
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
