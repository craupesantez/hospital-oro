@extends('brackets/admin-ui::admin.layout.master')

@section('title', trans('brackets/admin-auth::admin.login.title'))

@section('content')
	
	<div class="container-fluid" id="app">
    <div class="row no-gutter">
        <!-- The image half -->
        {{--  <div class="col-md-6 d-none d-md-flex bg-image"></div>  --}}
				<div class="col-md-6 d-none d-md-flex bg-primary"></div>
        <!-- The content half -->
        <div class="col-md-6 bg-light">
            <div class="login d-flex align-items-center py-5">

                <!-- Demo content-->
                <div class="container">
                    <div class="row">
                        <div class="col-lg-10 col-xl-7 mx-auto">
                            <h3 class="display-4">Hospital Básico del Oro</h3>
                            <p class="text-muted mb-4">Iniciar Sessión</p>
														<auth-form
															:action="'{{ url('/admin/login') }}'"
															:data="{}"
															inline-template>
															<form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/login') }}" novalidate>
																{{ csrf_field() }}

																<div class="auth-body">
																	@include('brackets/admin-auth::admin.auth.includes.messages')
																	<div class="form-group" :class="{'has-danger': errors.has('email'), 'has-success': fields.email && fields.email.valid }">

																		<div class="input-group input-group--custom">

																			<input type="text" v-model="form.email" v-validate="'required|email'" class="form-control rounded-pill border-0 shadow-sm px-4" :class="{'form-control-danger': errors.has('email'), 'form-control-success': fields.email && fields.email.valid}" id="email" name="email" placeholder="Correo electrónico">
																		</div>
																		<div v-if="errors.has('email')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('email') }}</div>
																	</div>
								
																	<div class="form-group" :class="{'has-danger': errors.has('password'), 'has-success': fields.password && fields.password.valid }">

																		<div class="input-group input-group--custom">

																			<input type="password" v-model="form.password"  class="form-control rounded-pill border-0 shadow-sm px-4 text-primary" :class="{'form-control-danger': errors.has('password'), 'form-control-success': fields.password && fields.password.valid}" id="password" name="password" placeholder="Contraseña">
																		</div>
																		<div v-if="errors.has('password')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('password') }}</div>
																	</div>
								
																	<div class="form-group">
																		<input type="hidden" name="remember" value="1">
																		<button type="submit" class="btn btn-primary btn-block text-uppercase mb-2 rounded-pill shadow-sm"><i class="fa"></i>Ingresar</button>
																	</div>
																	<div class="form-group text-center">
																		<a href="{{ url('/admin/password-reset') }}" class="auth-ghost-link">¿Olvidaste tu contraseña?</a>
																	</div>
																</div>
															</form>
														</auth-form>
                        </div>
                    </div>
                </div><!-- End -->

            </div>
        </div><!-- End -->

    </div>
</div>

   
@endsection


@section('bottom-scripts')
<script type="text/javascript">
    // fix chrome password autofill
    // https://github.com/vuejs/vue/issues/1331
    document.getElementById('password').dispatchEvent(new Event('input'));
</script>
@endsection