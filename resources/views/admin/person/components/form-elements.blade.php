<div class="form-group row align-items-center" :class="{'has-danger': errors.has('firt_name'), 'has-success': fields.firt_name && fields.firt_name.valid }">
    <label for="firt_name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.person.columns.firt_name') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.firt_name" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('firt_name'), 'form-control-success': fields.firt_name && fields.firt_name.valid}" id="firt_name" name="firt_name" placeholder="{{ trans('admin.person.columns.firt_name') }}">
        <div v-if="errors.has('firt_name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('firt_name') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('last_name'), 'has-success': fields.last_name && fields.last_name.valid }">
    <label for="last_name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.person.columns.last_name') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.last_name" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('last_name'), 'form-control-success': fields.last_name && fields.last_name.valid}" id="last_name" name="last_name" placeholder="{{ trans('admin.person.columns.last_name') }}">
        <div v-if="errors.has('last_name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('last_name') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('identification'), 'has-success': fields.identification && fields.identification.valid }">
    <label for="identification" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.person.columns.identification') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.identification" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('identification'), 'form-control-success': fields.identification && fields.identification.valid}" id="identification" name="identification" placeholder="{{ trans('admin.person.columns.identification') }}">
        <div v-if="errors.has('identification')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('identification') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('email'), 'has-success': fields.email && fields.email.valid }">
    <label for="email" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.person.columns.email') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.email" v-validate="'required|email'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('email'), 'form-control-success': fields.email && fields.email.valid}" id="email" name="email" placeholder="{{ trans('admin.person.columns.email') }}">
        <div v-if="errors.has('email')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('email') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('telephone'), 'has-success': fields.telephone && fields.telephone.valid }">
    <label for="telephone" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.person.columns.telephone') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.telephone" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('telephone'), 'form-control-success': fields.telephone && fields.telephone.valid}" id="telephone" name="telephone" placeholder="{{ trans('admin.person.columns.telephone') }}">
        <div v-if="errors.has('telephone')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('telephone') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('address'), 'has-success': fields.address && fields.address.valid }">
    <label for="address" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.person.columns.address') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.address" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('address'), 'form-control-success': fields.address && fields.address.valid}" id="address" name="address" placeholder="{{ trans('admin.person.columns.address') }}">
        <div v-if="errors.has('address')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('address') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('birthday'), 'has-success': fields.birthday && fields.birthday.valid }">
    <label for="birthday" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.person.columns.birthday') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-sm-8'">
        <div class="input-group input-group--custom">
            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
            <datetime v-model="form.birthday" :config="datePickerConfig" v-validate="'required|date_format:yyyy-MM-dd HH:mm:ss'" class="flatpickr" :class="{'form-control-danger': errors.has('birthday'), 'form-control-success': fields.birthday && fields.birthday.valid}" id="birthday" name="birthday" placeholder="{{ trans('brackets/admin-ui::admin.forms.select_a_date') }}"></datetime>
        </div>
        <div v-if="errors.has('birthday')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('birthday') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('gender'), 'has-success': fields.gender && fields.gender.valid }">
    <label for="gender" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.person.columns.gender') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.gender" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('gender'), 'form-control-success': fields.gender && fields.gender.valid}" id="gender" name="gender" placeholder="{{ trans('admin.person.columns.gender') }}">
        <div v-if="errors.has('gender')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('gender') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('id_cities'), 'has-success': fields.id_cities && fields.id_cities.valid }">
    <label for="id_cities" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.person.columns.id_cities') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.id_cities" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('id_cities'), 'form-control-success': fields.id_cities && fields.id_cities.valid}" id="id_cities" name="id_cities" placeholder="{{ trans('admin.person.columns.id_cities') }}">
        <div v-if="errors.has('id_cities')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('id_cities') }}</div>
    </div>
</div>


