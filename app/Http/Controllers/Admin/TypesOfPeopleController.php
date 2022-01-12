<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TypesOfPerson\BulkDestroyTypesOfPerson;
use App\Http\Requests\Admin\TypesOfPerson\DestroyTypesOfPerson;
use App\Http\Requests\Admin\TypesOfPerson\IndexTypesOfPerson;
use App\Http\Requests\Admin\TypesOfPerson\StoreTypesOfPerson;
use App\Http\Requests\Admin\TypesOfPerson\UpdateTypesOfPerson;
use App\Models\TypesOfPerson;
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

class TypesOfPeopleController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexTypesOfPerson $request
     * @return array|Factory|View
     */
    public function index(IndexTypesOfPerson $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(TypesOfPerson::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'name', 'description'],

            // set columns to searchIn
            ['id', 'name', 'description']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.types-of-person.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.types-of-person.create');

        return view('admin.types-of-person.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTypesOfPerson $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreTypesOfPerson $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the TypesOfPerson
        $typesOfPerson = TypesOfPerson::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/types-of-people'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/types-of-people');
    }

    /**
     * Display the specified resource.
     *
     * @param TypesOfPerson $typesOfPerson
     * @throws AuthorizationException
     * @return void
     */
    public function show(TypesOfPerson $typesOfPerson)
    {
        $this->authorize('admin.types-of-person.show', $typesOfPerson);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param TypesOfPerson $typesOfPerson
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(TypesOfPerson $typesOfPerson)
    {
        $this->authorize('admin.types-of-person.edit', $typesOfPerson);


        return view('admin.types-of-person.edit', [
            'typesOfPerson' => $typesOfPerson,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTypesOfPerson $request
     * @param TypesOfPerson $typesOfPerson
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateTypesOfPerson $request, TypesOfPerson $typesOfPerson)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values TypesOfPerson
        $typesOfPerson->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/types-of-people'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/types-of-people');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyTypesOfPerson $request
     * @param TypesOfPerson $typesOfPerson
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyTypesOfPerson $request, TypesOfPerson $typesOfPerson)
    {
        $typesOfPerson->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyTypesOfPerson $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyTypesOfPerson $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    TypesOfPerson::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
