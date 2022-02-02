<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">{{ trans('brackets/admin-ui::admin.sidebar.content') }}</li>
            <li class="nav-item"><a class="nav-link" href="{{ url('admin/roles') }}"><i class="nav-icon icon-diamond"></i> {{ trans('admin.role.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/cities') }}"><i class="nav-icon icon-ghost"></i> {{ trans('admin.city.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/specialties') }}"><i class="nav-icon icon-energy"></i> {{ trans('admin.specialty.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/exams') }}"><i class="nav-icon icon-globe"></i> {{ trans('admin.exam.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/people') }}"><i class="nav-icon icon-umbrella"></i> {{ trans('admin.person.title') }}</a></li>
           {{--  <li class="nav-item"><a class="nav-link" href="{{ url('admin/type-person-has-people') }}"><i class="nav-icon icon-star"></i> {{ trans('admin.type-person-has-person.title') }}</a></li>  --}}
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/schedules') }}"><i class="nav-icon icon-flag"></i> {{ trans('admin.schedule.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/appointments') }}"><i class="nav-icon icon-compass"></i> {{ trans('admin.appointment.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/types-of-people') }}"><i class="nav-icon icon-diamond"></i> {{ trans('admin.types-of-person.title') }}</a></li>
           {{--  <li class="nav-item"><a class="nav-link" href="{{ url('admin/specialists') }}"><i class="nav-icon icon-star"></i> {{ trans('admin.specialist.title') }}</a></li>  --}}
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/medicines') }}"><i class="nav-icon icon-globe"></i> {{ trans('admin.medicine.title') }}</a></li>
           {{-- Do not delete me :) I'm used for auto-generation menu items --}}
           

            <li class="nav-title">{{ trans('brackets/admin-ui::admin.sidebar.settings') }}</li>
            <li class="nav-item"><a class="nav-link" href="{{ url('admin/admin-users') }}"><i class="nav-icon icon-user"></i> {{ __('Manage access') }}</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('admin/translations') }}"><i class="nav-icon icon-location-pin"></i> {{ __('Translations') }}</a></li>
            
            {{-- Do not delete me :) I'm also used for auto-generation menu items --}}
            {{--  <li class="nav-item"><a class="nav-link" href="{{ url('admin/configuration') }}"><i class="nav-icon icon-settings"></i> {{ __('Configuration') }}</a></li>  --}}
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
