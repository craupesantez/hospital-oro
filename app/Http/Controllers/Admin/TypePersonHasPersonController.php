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
     * 
     *
     * @param IndexTypePersonHasPerson $request
     * @return array|Factory|View
     */
    public function index(IndexTypePersonHasPerson $request)
    {
        $data = AdminListing::create(TypePersonHasPerson::class)->processRequestAndGet(
            
            $request,

            ['id', 'id_person', 'id_type_of_people'],

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
     * 
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
     * 
     *
     * @param StoreTypePersonHasPerson $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreTypePersonHasPerson $request)
    {
        $sanitized = $request->getSanitized();

        $typePersonHasPerson = TypePersonHasPerson::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/type-person-has-people'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/type-person-has-people');
    }

    /**
     * 
     *
     * @param TypePersonHasPerson $typePersonHasPerson
     * @throws AuthorizationException
     * @return void
     */
    public function show(TypePersonHasPerson $typePersonHasPerson)
    {
        $this->authorize('admin.type-person-has-person.show', $typePersonHasPerson);

    }

    /**
     *
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
     * 
     *
     * @param UpdateTypePersonHasPerson $request
     * @param TypePersonHasPerson $typePersonHasPerson
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateTypePersonHasPerson $request, TypePersonHasPerson $typePersonHasPerson)
    {
        
        $sanitized = $request->getSanitized();

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
     * 
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
     * 
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

                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
