<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Schedule\BulkDestroySchedule;
use App\Http\Requests\Admin\Schedule\DestroySchedule;
use App\Http\Requests\Admin\Schedule\IndexSchedule;
use App\Http\Requests\Admin\Schedule\StoreSchedule;
use App\Http\Requests\Admin\Schedule\UpdateSchedule;
use App\Models\Schedule;
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

class ScheduleController extends Controller
{

    /**
     * 
     *
     * @param IndexSchedule $request
     * @return array|Factory|View
     */
    public function index(IndexSchedule $request)
    {
        $data = AdminListing::create(Schedule::class)->processRequestAndGet(

            $request,

            ['id', 'name', 'hour_start', 'hour_end'],

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

        return view('admin.schedule.index', ['data' => $data]);
    }

    /**
     * 
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.schedule.create');

        return view('admin.schedule.create');
    }

    /**
     * 
     *
     * @param StoreSchedule $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreSchedule $request)
    {
        $sanitized = $request->getSanitized();

        $schedule = Schedule::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/schedules'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/schedules');
    }

    /**
     * 
     *
     * @param Schedule $schedule
     * @throws AuthorizationException
     * @return void
     */
    public function show(Schedule $schedule)
    {
        $this->authorize('admin.schedule.show', $schedule);

    }

    /**
     * 
     *
     * @param Schedule $schedule
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Schedule $schedule)
    {
        $this->authorize('admin.schedule.edit', $schedule);


        return view('admin.schedule.edit', [
            'schedule' => $schedule,
        ]);
    }

    /**
     * 
     *
     * @param UpdateSchedule $request
     * @param Schedule $schedule
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateSchedule $request, Schedule $schedule)
    {
        $sanitized = $request->getSanitized();

        $schedule->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/schedules'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/schedules');
    }

    /**
     * 
     *
     * @param DestroySchedule $request
     * @param Schedule $schedule
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroySchedule $request, Schedule $schedule)
    {
        $schedule->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * 
     *
     * @param BulkDestroySchedule $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroySchedule $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Schedule::whereIn('id', $bulkChunk)->delete();

                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
