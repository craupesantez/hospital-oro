<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TypePersonHasPerson\BulkDestroyTypePersonHasPerson;
use App\Http\Requests\Admin\TypePersonHasPerson\DestroyTypePersonHasPerson;
use App\Http\Requests\Admin\TypePersonHasPerson\IndexTypePersonHasPerson;
use App\Http\Requests\Admin\TypePersonHasPerson\StoreTypePersonHasPerson;
use App\Http\Requests\Admin\TypePersonHasPerson\UpdateTypePersonHasPerson;
use App\Models\TypePersonHasPerson;
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

class TypePersonHasPersonController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexTypePersonHasPerson $request
     * @return array|Factory|View
     */
    public function index(IndexTypePersonHasPerson $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(TypePersonHasPerson::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'id_person', 'id_type_of_people'],

            // set columns to searchIn
            ['id']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.type-person-has-person.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.type-person-has-person.create');

        return view('admin.type-person-has-person.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTypePersonHasPerson $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreTypePersonHasPerson $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the TypePersonHasPerson
        $typePersonHasPerson = TypePersonHasPerson::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/type-person-has-people'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/type-person-has-people');
    }

    /**
     * Display the specified resource.
     *
     * @param TypePersonHasPerson $typePersonHasPerson
     * @throws AuthorizationException
     * @return void
     */
    public function show(TypePersonHasPerson $typePersonHasPerson)
    {
        $this->authorize('admin.type-person-has-person.show', $typePersonHasPerson);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param TypePersonHasPerson $typePersonHasPerson
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(TypePersonHasPerson $typePersonHasPerson)
    {
        $this->authorize('admin.type-person-has-person.edit', $typePersonHasPerson);


        return view('admin.type-person-has-person.edit', [
            'typePersonHasPerson' => $typePersonHasPerson,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTypePersonHasPerson $request
     * @param TypePersonHasPerson $typePersonHasPerson
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateTypePersonHasPerson $request, TypePersonHasPerson $typePersonHasPerson)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values TypePersonHasPerson
        $typePersonHasPerson->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/type-person-has-people'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/type-person-has-people');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyTypePersonHasPerson $request
     * @param TypePersonHasPerson $typePersonHasPerson
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyTypePersonHasPerson $request, TypePersonHasPerson $typePersonHasPerson)
    {
        $typePersonHasPerson->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyTypePersonHasPerson $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyTypePersonHasPerson $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    TypePersonHasPerson::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
