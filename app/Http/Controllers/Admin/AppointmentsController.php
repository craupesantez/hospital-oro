<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Appointment\BulkDestroyAppointment;
use App\Http\Requests\Admin\Appointment\DestroyAppointment;
use App\Http\Requests\Admin\Appointment\IndexAppointment;
use App\Http\Requests\Admin\Appointment\StoreAppointment;
use App\Http\Requests\Admin\Appointment\UpdateAppointment;
use App\Models\Appointment;
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

class AppointmentsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param IndexAppointment $request
     * @return array|Factory|View
     */
    public function index(IndexAppointment $request)
    {
        // create and AdminListing instance for a specific model and
        $data = AdminListing::create(Appointment::class)->processRequestAndGet(
            // pass the request with params
            $request,

            // set columns to query
            ['id', 'status', 'prescription', 'comment', 'diagnosis', 'reason', 'id_person', 'id_specialist'],

            // set columns to searchIn
            ['id', 'status', 'prescription', 'comment', 'diagnosis', 'reason']
        );

        if ($request->ajax()) {
            if ($request->has('bulk')) {
                return [
                    'bulkItems' => $data->pluck('id')
                ];
            }
            return ['data' => $data];
        }

        return view('admin.appointment.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.appointment.create');

        return view('admin.appointment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAppointment $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreAppointment $request)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Store the Appointment
        $appointment = Appointment::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/appointments'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/appointments');
    }

    /**
     * Display the specified resource.
     *
     * @param Appointment $appointment
     * @throws AuthorizationException
     * @return void
     */
    public function show(Appointment $appointment)
    {
        $this->authorize('admin.appointment.show', $appointment);

        // TODO your code goes here
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Appointment $appointment
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Appointment $appointment)
    {
        $this->authorize('admin.appointment.edit', $appointment);


        return view('admin.appointment.edit', [
            'appointment' => $appointment,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateAppointment $request
     * @param Appointment $appointment
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateAppointment $request, Appointment $appointment)
    {
        // Sanitize input
        $sanitized = $request->getSanitized();

        // Update changed values Appointment
        $appointment->update($sanitized);

        if ($request->ajax()) {
            return [
                'redirect' => url('admin/appointments'),
                'message' => trans('brackets/admin-ui::admin.operation.succeeded'),
            ];
        }

        return redirect('admin/appointments');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyAppointment $request
     * @param Appointment $appointment
     * @throws Exception
     * @return ResponseFactory|RedirectResponse|Response
     */
    public function destroy(DestroyAppointment $request, Appointment $appointment)
    {
        $appointment->delete();

        if ($request->ajax()) {
            return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param BulkDestroyAppointment $request
     * @throws Exception
     * @return Response|bool
     */
    public function bulkDestroy(BulkDestroyAppointment $request) : Response
    {
        DB::transaction(static function () use ($request) {
            collect($request->data['ids'])
                ->chunk(1000)
                ->each(static function ($bulkChunk) {
                    Appointment::whereIn('id', $bulkChunk)->delete();

                    // TODO your code goes here
                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
