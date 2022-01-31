<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Registro</title>
    <style>
        .register,
        .image {
            min-height: 100vh;
        }

        .bg-image {
            background-image: url('https://bootstrapious.com/i/snippets/sn-page-split/bg.jpg');
            background-size: cover;
            background-position: center center;
        }

    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row no-gutter">
            <!-- The image half -->
            <div class="col-md-6 d-none d-md-flex bg-primary">
                {{-- no aplicar nada --}}
            </div>
            <!-- The content half -->
            <div class="col-md-6 bg-light">
                <div class="register d-flex align-items-center py-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-10 col-xl-7 mx-auto">
                                <h3 class="display-4">Hospital Básico del Oro</h3>
                                <p class="text-muted mb-4">Registro de Paciente</p>
                                <!-- Validation Errors -->
                                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                                <form method="POST" action="{{ route('register') }}" class="form-horizontal">
                                    @csrf

                                    <div class="auth-body">
                                        <!-- Name -->
                                        <div class="form-group">
                                            <label for="first_name">Nombres</label>
                                            <div class="input-group input-group--custom">
                                                <x-input id="first_name" type="text" name="first_name"
                                                    :value="old('first_name')" placeholder="Nombres"
                                                    class="mt-1" />
                                            </div>
                                        </div>

                                        <!-- Apellidos -->
                                        <div class="form-group">
                                            <label for="last_name">Apellidos</label>
                                            <div class="input-group input-group--custom">
                                                <x-input id="last_name" class="mt-1" type="text"
                                                    name="last_name" :value="old('last_name')"
                                                    placeholder="Apellidos" />
                                            </div>
                                        </div>

                                        <!-- identification -->
                                        <div class="form-group">
                                            <label for="last_name">Identificación</label>
                                            <div class="input-group input-group--custom">
                                                <x-input id="identification" class="mt-1" type="text"
                                                    name="identification" :value="old('identification')"
                                                    placeholder="Identificación" />
                                            </div>
                                        </div>

                                        <!-- Email Address -->
                                        <div class="form-group">
                                            {{-- <x-label for="email" :value="__('correo electrónico')" /> --}}
                                            <label for="email">Correo Electrónico</label>
                                            <div class="input-group input-group--custom">
                                                <x-input class="mt-1" id="email" type="email" name="email"
                                                    :value="old('email')" placeholder="Correo electrónico" />
                                            </div>

                                        </div>

                                        <!-- telephone -->
                                        <div class="form-group">
                                            <label for="telephone">Teléfono</label>
                                            <div class="input-group input-group--custom">
                                                <x-input id="telephone" class="mt-1" type="text"
                                                    name="telephone" :value="old('telephone')" placeholder="Teléfono" />
                                            </div>
                                        </div>

                                        <!-- address -->
                                        <div class="form-group">
                                            <label for="address">Dirección</label>
                                            <div class="input-group input-group--custom">
                                                <x-input id="address" class="mt-1" type="text" name="address"
                                                    :value="old('address')" placeholder="Dirección" />
                                            </div>
                                        </div>

                                        <!-- fecha de nacimiento -->
                                        <div class="form-group">
                                            <label for="birthday">Fecha de nacimiento</label>
                                            <div class="input-group input-group--custom">
                                                <x-calendar class="mt-1"
                                                    v-validate="'required|date_format:yyyy-MM-dd HH:mm:ss'"
                                                    id="birthday" name="birthday" :value="old('birthday')"
                                                    placeholder="Fecha de nacimiento" />
                                            </div>

                                        </div>

                                        <!-- fecha de genero -->
                                        <div class="form-group">
                                            {{-- <x-label for="email" :value="__('correo electrónico')" /> --}}
                                            <label for="gender">Genero</label>
                                            <div class="input-group input-group--custom">
                                                <select :class="mt-1" v-validate="'required'" id="gender" name="gender"
                                                    :value="old('gender')"
                                                    placeholder="{{ trans('brackets/admin-ui::admin.forms.select_options') }}"
                                                    class="form-select rounded-pill border-0 shadow-sm px-4">
                                                    <option value="Masculino">Masculino</option>
                                                    <option value="Femenino">Femenino</option>
                                                </select>
                                            </div>

                                        </div>

                                        <!-- city -->
                                        <div class="form-group">
                                            {{-- <x-label for="email" :value="__('correo electrónico')" /> --}}
                                            <label for="id_cities">Ciudad</label>
                                            <div class="input-group input-group--custom">
                                                <select :class="mt-1" v-validate="'required'" id="id_cities" name="id_cities"
                                                    :value="old('id_cities')"
                                                    placeholder="{{ trans('brackets/admin-ui::admin.forms.select_options') }}"
                                                    class="form-select rounded-pill border-0 shadow-sm px-4">
                                                    @foreach ($cities as $city)
                                                        <option value="{{ $city->id }}">{{ $city->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                        </div>

                                        <!-- Password -->
                                        <div class="form-group">
                                            {{-- <x-label for="password" :value="__('Contraseña')" /> --}}
                                            <label for="password">Contrasña</label>
                                            <div class="input-group input-group--custom mt-1">
                                                <x-input id="password" type="password" name="password" required
                                                    autocomplete="new-password" placeholder="Contraseña" />
                                            </div>
                                        </div>

                                        <!-- Confirm Password -->
                                        <div class="form-group">
                                            <label for="password_confirmation">Confirmar contraseña</label>
                                            {{-- <x-label for="password_confirmation" :value="__('Confirmar contraseña')" /> --}}
                                            <div class="input-group input-group--custom mt-1">
                                                <x-input id="password_confirmation" type="password"
                                                    name="password_confirmation" required
                                                    placeholder="Confirmar contraseña" />
                                            </div>
                                        </div>

                                        <div class="form-group mt-4">
                                            <input type="hidden" name="remember" value="1">
                                            <x-button style="padding: 5px 245px;">
                                                <i class="fa"></i> {{ __('Registrar') }}
                                            </x-button>
                                        </div>
                                        <a class="underline text-sm text-gray-600 hover:text-gray-900"
                                            href="{{ route('login') }}">
                                            {{ __('¿Ya registrado?') }}
                                        </a>
                                    </div>

                                </form>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
    {{-- </x-auth-card> --}}
    {{-- </x-guest-layout> --}}

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</html>
