<div class="form-group row align-items-center" :class="{'has-danger': errors.has('name'), 'has-success': fields.name && fields.name.valid }">
    <label for="name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.city.columns.name') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.name" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('name'), 'form-control-success': fields.name && fields.name.valid}" id="name" name="name" placeholder="{{ trans('admin.city.columns.name') }}">
        <div v-if="errors.has('name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('name') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('postal_code'), 'has-success': fields.postal_code && fields.postal_code.valid }">
    <label for="postal_code" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.city.columns.postal_code') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.postal_code" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('postal_code'), 'form-control-success': fields.postal_code && fields.postal_code.valid}" id="postal_code" name="postal_code" placeholder="{{ trans('admin.city.columns.postal_code') }}">
        <div v-if="errors.has('postal_code')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('postal_code') }}</div>
    </div>
</div>


