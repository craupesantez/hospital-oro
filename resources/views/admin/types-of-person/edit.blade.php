@extends('brackets/admin-ui::admin.layout.default')

@section('title', trans('admin.types-of-person.actions.edit', ['name' => $typesOfPerson->name]))

@section('body')

    <div class="container-xl">
        <div class="card">

            <types-of-person-form
                :action="'{{ $typesOfPerson->resource_url }}'"
                :data="{{ $typesOfPerson->toJson() }}"
                v-cloak
                inline-template>
            
                <form class="form-horizontal form-edit" method="post" @submit.prevent="onSubmit" :action="action" novalidate>


                    <div class="card-header">
                        <i class="fa fa-pencil"></i> {{ trans('admin.types-of-person.actions.edit', ['name' => $typesOfPerson->name]) }}
                    </div>

                    <div class="card-body">
                        @include('admin.types-of-person.components.form-elements')
                    </div>
                    
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            {{ trans('brackets/admin-ui::admin.btn.save') }}
                        </button>
                    </div>
                    
                </form>

        </types-of-person-form>

        </div>
    
</div>

@endsection