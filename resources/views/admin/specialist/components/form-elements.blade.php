<div class="form-group row align-items-center"
    :class="{'has-danger': errors.has('id_person'), 'has-success': fields.id_person && fields.id_person.valid }">
    <label for="id_person" class="col-form-label text-md-right"
        :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.specialist.columns.id_person') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.id_person" v-validate="'required'" @input="validate($event)"
            class="form-control"
            :class="{'form-control-danger': errors.has('id_person'), 'form-control-success': fields.id_person && fields.id_person.valid}"
            id="id_person" name="id_person" placeholder="{{ trans('admin.specialist.columns.id_person') }}">
        <div v-if="errors.has('id_person')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('id_person') }}</div>
    </div>
</div>

<div class="form-group row align-items-center"
    :class="{'has-danger': errors.has('id_specialities'), 'has-success': fields.id_specialities && fields.id_specialities.valid }">
    <label for="id_specialities" class="col-form-label text-md-right"
        :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.specialist.columns.id_specialities') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.id_specialities" v-validate="'required'" @input="validate($event)"
            class="form-control"
            :class="{'form-control-danger': errors.has('id_specialities'), 'form-control-success': fields.id_specialities && fields.id_specialities.valid}"
            id="id_specialities" name="id_specialities"
            placeholder="{{ trans('admin.specialist.columns.id_specialities') }}">
        <div v-if="errors.has('id_specialities')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('id_specialities') }}
        </div>
    </div>
</div>

<div class="form-group row align-items-center"
    :class="{'has-danger': errors.has('year_of_specialization'), 'has-success': fields.year_of_specialization && fields.year_of_specialization.valid }">
    <label for="year_of_specialization" class="col-form-label text-md-right"
        :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.specialist.columns.year_of_specialization') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.year_of_specialization" v-validate="'required'" @input="validate($event)"
            class="form-control"
            :class="{'form-control-danger': errors.has('year_of_specialization'), 'form-control-success': fields.year_of_specialization && fields.year_of_specialization.valid}"
            id="year_of_specialization" name="year_of_specialization"
            placeholder="{{ trans('admin.specialist.columns.year_of_specialization') }}">
        <div v-if="errors.has('year_of_specialization')" class="form-control-feedback form-text" v-cloak>
            @{{ errors.first('year_of_specialization') }}</div>
    </div>
</div>

<div class="form-group row align-items-center"
    :class="{'has-danger': errors.has('institution'), 'has-success': fields.institution && fields.institution.valid }">
    <label for="institution" class="col-form-label text-md-right"
        :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.specialist.columns.institution') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.institution" v-validate="'required'" @input="validate($event)"
            class="form-control"
            :class="{'form-control-danger': errors.has('institution'), 'form-control-success': fields.institution && fields.institution.valid}"
            id="institution" name="institution" placeholder="{{ trans('admin.specialist.columns.institution') }}">
        <div v-if="errors.has('institution')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('institution') }}
        </div>
    </div>
</div>
