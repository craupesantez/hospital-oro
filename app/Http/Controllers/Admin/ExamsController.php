<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Exam\BulkDestroyExam;
use App\Http\Requests\Admin\Exam\DestroyExam;
use App\Http\Requests\Admin\Exam\IndexExam;
use App\Http\Requests\Admin\Exam\StoreExam;
use App\Http\Requests\Admin\Exam\UpdateExam;
use App\Models\Exam;
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

class ExamsController extends Controller
{

    /**
     * 
     *
     * @param IndexExam $request
     * @return array|Factory|View
     */
    public function index(IndexExam $request)
    {
        $data = AdminListing::create(Exam::class)->processRequestAndGet(

            $request,

            ['id', 'name', 'description'],

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

        return view('admin.exam.index', ['data' => $data]);
    }

    /**
     * 
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.exam.create');

        return view('admin.exam.create');
    }

    /**
     * 
     *
     * @param StoreExam $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreExam $request)
    {
        $sanitized = $request->getSanitized();

        $exam = Exam::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/exams'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/exams');
    }

    /**
     * 
     *
     * @param Exam $exam
     * @throws AuthorizationException
     * @return void
     */
    public function show(Exam $exam)
    {
        $this->authorize('admin.exam.show', $exam);

    }

    /**
     *
     *
     * @param Exam $exam
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Exam $exam)
    {
        $this->authorize('admin.exam.edit', $exam);


        return view('admin.exam.edit', [
            'exam' => $exam,
        ]);
    }

    /**
     * 
     *
     * @param UpdateExam $request
     * @param Exam $exam
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateExam $request, Exam $exam)
    {
        $sanitized = $request->getSanitized();

        $exam->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/exams'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/exams');
    }

    /**
     * 
     *
     * @param DestroyExam $request
     * @param Exam $exam
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyExam $request, Exam $exam)
    {
        $exam->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * 
     *
     * @param BulkDestroyExam $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyExam $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Exam::whereIn('id', $bulkChunk)->delete();

                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
