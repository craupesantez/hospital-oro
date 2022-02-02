<div class="form-group row align-items-center"
    :class="{'has-danger': errors.has('status'), 'has-success': fields.status && fields.status.valid }">
    <label for="status" class="col-form-label text-md-right"
        :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.appointment.columns.status') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.status" v-validate="'required'" @input="validate($event)" class="form-control"
            :class="{'form-control-danger': errors.has('status'), 'form-control-success': fields.status && fields.status.valid}"
            id="status" name="status" placeholder="{{ trans('admin.appointment.columns.status') }}">
        <div v-if="errors.has('status')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('status') }}</div>
    </div>
</div>

<div class="form-group row align-items-center"
    :class="{'has-danger': errors.has('prescription'), 'has-success': fields.prescription && fields.prescription.valid }">
    <label for="prescription" class="col-form-label text-md-right"
        :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.appointment.columns.prescription') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.prescription" v-validate="''" @input="validate($event)" class="form-control"
            :class="{'form-control-danger': errors.has('prescription'), 'form-control-success': fields.prescription && fields.prescription.valid}"
            id="prescription" name="prescription" placeholder="{{ trans('admin.appointment.columns.prescription') }}">
        <div v-if="errors.has('prescription')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('prescription') }}
        </div>
    </div>
</div>

<div class="form-group row align-items-center"
    :class="{'has-danger': errors.has('comment'), 'has-success': fields.comment && fields.comment.valid }">
    <label for="comment" class="col-form-label text-md-right"
        :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.appointment.columns.comment') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.comment" v-validate="''" @input="validate($event)" class="form-control"
            :class="{'form-control-danger': errors.has('comment'), 'form-control-success': fields.comment && fields.comment.valid}"
            id="comment" name="comment" placeholder="{{ trans('admin.appointment.columns.comment') }}">
        <div v-if="errors.has('comment')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('comment') }}</div>
    </div>
</div>

<div class="form-group row align-items-center"
    :class="{'has-danger': errors.has('diagnosis'), 'has-success': fields.diagnosis && fields.diagnosis.valid }">
    <label for="diagnosis" class="col-form-label text-md-right"
        :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.appointment.columns.diagnosis') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.diagnosis" v-validate="''" @input="validate($event)" class="form-control"
            :class="{'form-control-danger': errors.has('diagnosis'), 'form-control-success': fields.diagnosis && fields.diagnosis.valid}"
            id="diagnosis" name="diagnosis" placeholder="{{ trans('admin.appointment.columns.diagnosis') }}">
        <div v-if="errors.has('diagnosis')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('diagnosis') }}</div>
    </div>
</div>

<div class="form-group row align-items-center"
    :class="{'has-danger': errors.has('reason'), 'has-success': fields.reason && fields.reason.valid }">
    <label for="reason" class="col-form-label text-md-right"
        :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.appointment.columns.reason') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.reason" v-validate="'required'" @input="validate($event)"
            class="form-control"
            :class="{'form-control-danger': errors.has('reason'), 'form-control-success': fields.reason && fields.reason.valid}"
            id="reason" name="reason" placeholder="{{ trans('admin.appointment.columns.reason') }}">
        <div v-if="errors.has('reason')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('reason') }}</div>
    </div>
</div>

<div class="form-group row align-items-center"
    :class="{'has-danger': errors.has('id_person'), 'has-success': fields.id_person && fields.id_person.valid }">
    <label for="id_person" class="col-form-label text-md-right"
        :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.appointment.columns.id_person') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.id_person" v-validate="'required'" @input="validate($event)"
            class="form-control"
            :class="{'form-control-danger': errors.has('id_person'), 'form-control-success': fields.id_person && fields.id_person.valid}"
            id="id_person" name="id_person" placeholder="{{ trans('admin.appointment.columns.id_person') }}">
        <div v-if="errors.has('id_person')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('id_person') }}</div>
    </div>
</div>

<div class="form-group row align-items-center"
    :class="{'has-danger': errors.has('id_specialist'), 'has-success': fields.id_specialist && fields.id_specialist.valid }">
    <label for="id_specialist" class="col-form-label text-md-right"
        :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.appointment.columns.id_specialist') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.id_specialist" v-validate="'required'" @input="validate($event)"
            class="form-control"
            :class="{'form-control-danger': errors.has('id_specialist'), 'form-control-success': fields.id_specialist && fields.id_specialist.valid}"
            id="id_specialist" name="id_specialist"
            placeholder="{{ trans('admin.appointment.columns.id_specialist') }}">
        <div v-if="errors.has('id_specialist')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('id_specialist') }}
        </div>
    </div>
</div>
