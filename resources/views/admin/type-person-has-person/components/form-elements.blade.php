<div class="form-group row align-items-center" :class="{'has-danger': errors.has('id_person'), 'has-success': fields.id_person && fields.id_person.valid }">
    <label for="id_person" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.type-person-has-person.columns.id_person') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.id_person" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('id_person'), 'form-control-success': fields.id_person && fields.id_person.valid}" id="id_person" name="id_person" placeholder="{{ trans('admin.type-person-has-person.columns.id_person') }}">
        <div v-if="errors.has('id_person')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('id_person') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('id_type_of_people'), 'has-success': fields.id_type_of_people && fields.id_type_of_people.valid }">
    <label for="id_type_of_people" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.type-person-has-person.columns.id_type_of_people') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.id_type_of_people" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('id_type_of_people'), 'form-control-success': fields.id_type_of_people && fields.id_type_of_people.valid}" id="id_type_of_people" name="id_type_of_people" placeholder="{{ trans('admin.type-person-has-person.columns.id_type_of_people') }}">
        <div v-if="errors.has('id_type_of_people')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('id_type_of_people') }}</div>
    </div>
</div>


