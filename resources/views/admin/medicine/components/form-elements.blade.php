<div class="form-group row align-items-center" :class="{'has-danger': errors.has('name'), 'has-success': fields.name && fields.name.valid }">
    <label for="name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.medicine.columns.name') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.name" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('name'), 'form-control-success': fields.name && fields.name.valid}" id="name" name="name" placeholder="{{ trans('admin.medicine.columns.name') }}">
        <div v-if="errors.has('name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('name') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('indications'), 'has-success': fields.indications && fields.indications.valid }">
    <label for="indications" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.medicine.columns.indications') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.indications" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('indications'), 'form-control-success': fields.indications && fields.indications.valid}" id="indications" name="indications" placeholder="{{ trans('admin.medicine.columns.indications') }}">
        <div v-if="errors.has('indications')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('indications') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('amount'), 'has-success': fields.amount && fields.amount.valid }">
    <label for="amount" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.medicine.columns.amount') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.amount" v-validate="'integer'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('amount'), 'form-control-success': fields.amount && fields.amount.valid}" id="amount" name="amount" placeholder="{{ trans('admin.medicine.columns.amount') }}">
        <div v-if="errors.has('amount')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('amount') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('measure'), 'has-success': fields.measure && fields.measure.valid }">
    <label for="measure" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.medicine.columns.measure') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.measure" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('measure'), 'form-control-success': fields.measure && fields.measure.valid}" id="measure" name="measure" placeholder="{{ trans('admin.medicine.columns.measure') }}">
        <div v-if="errors.has('measure')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('measure') }}</div>
    </div>
</div>


