<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Appointment\BulkDestroyAppointment;
use App\Http\Requests\Admin\Appointment\DestroyAppointment;
use App\Http\Requests\Admin\Appointment\IndexAppointment;
use App\Http\Requests\Admin\Appointment\StoreAppointment;
use App\Http\Requests\Admin\Appointment\UpdateAppointment;
use App\Models\Appointment;
use App\Models\Person;
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
        $data = AdminListing::create(Appointment::class)->processRequestAndGet(
            $request,

            ['id', 'status', 'prescription', 'comment', 'diagnosis', 'reason', 'id_person', 'id_specialist'],

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
     *
     *
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function create()
    {
        $this->authorize('admin.appointment.create');

        
        return view('admin.appointment.create',[
            'pacientes'=>Person::join('type_person_has_person', 'persons.id','=','type_person_has_person.id_person')
                    ->join('types_of_people','types_of_people.id','=', 'type_person_has_person.id_type_of_people')
                    ->select('persons.firt_name','persons.last_name', 'persons.id')
                    ->where('types_of_people.name','=','Paciente')
                    ->get(),
            'especialistas'=>Person::join('specialists','persons.id','=','specialists.id_person')
                    ->join('specialties','specialties.id','=','specialists.id_specialities',)
                    ->join('type_person_has_person', 'persons.id','=','type_person_has_person.id_person')
                    ->join('types_of_people','types_of_people.id','=', 'type_person_has_person.id_type_of_people')
                    ->select('persons.firt_name','persons.last_name', 'specialties.name', 'specialists.id')
                    ->where('types_of_people.name','=','Medico')
                    ->get()
        ]);


    }

    /**
     * 
     *
     * @param StoreAppointment $request
     * @return array|RedirectResponse|Redirector
     */
    public function store(StoreAppointment $request)
    {
        $sanitized = $request->getSanitized();

        $appointment = Appointment::create($sanitized);

        if ($request->ajax()) {
            return ['redirect' => url('admin/appointments'), 'message' => trans('brackets/admin-ui::admin.operation.succeeded')];
        }

        return redirect('admin/appointments');
    }

    /**
     * 
     *
     * @param Appointment $appointment
     * @throws AuthorizationException
     * @return void
     */
    public function show(Appointment $appointment)
    {
        $this->authorize('admin.appointment.show', $appointment);

    }

    /**
     * 
     *
     * @param Appointment $appointment
     * @throws AuthorizationException
     * @return Factory|View
     */
    public function edit(Appointment $appointment)
    {
        $this->authorize('admin.appointment.edit', $appointment);

        $pacientes=Person::join('type_person_has_person', 'persons.id','=','type_person_has_person.id_person')
                    ->join('types_of_people','types_of_people.id','=', 'type_person_has_person.id_type_of_people')
                    ->select('persons.firt_name','persons.last_name', 'persons.id')
                    ->where('types_of_people.name','=','Paciente')
                    ->where('persons.id','=',$appointment->id_person)
                    ->get();
        $especialistas=Person::join('specialists','persons.id','=','specialists.id_person')
                    ->join('specialties','specialties.id','=','specialists.id_specialities',)
                    ->join('type_person_has_person', 'persons.id','=','type_person_has_person.id_person')
                    ->join('types_of_people','types_of_people.id','=', 'type_person_has_person.id_type_of_people')
                    ->select('persons.firt_name','persons.last_name', 'specialties.name', 'specialists.id')
                    ->where('types_of_people.name','=','Medico')
                    ->where('specialists.id','=',$appointment->id_specialist)
                    ->get();

        return view('admin.appointment.edit', [
            'appointment' => $appointment,
            'pacientes'=> $pacientes,
            'especialistas'=> $especialistas
        ]);
    }

    /**
     * 
     *
     * @param UpdateAppointment $request
     * @param Appointment $appointment
     * @return array|RedirectResponse|Redirector
     */
    public function update(UpdateAppointment $request, Appointment $appointment)
    {
        $sanitized = $request->getSanitized();

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
     *
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
     *
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

                });
        });

        return response(['message' => trans('brackets/admin-ui::admin.operation.succeeded')]);
    }
}
