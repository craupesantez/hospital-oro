<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Activation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are the default lines which match reasons
    | that are given by the activation broker for a account activation attempt
    | has failed, such as for an invalid token or invalid user.
    |
    */

    'sent' => '¡Le hemos enviado un enlace de activación!',
    'activated' => '¡Tu cuenta fue activada!',
    'token' => 'El token de activación no es válido.',
    'user' => "No podemos encontrar un usuario con las credenciales enviadas. Es posible que el usuario ya esté activado.",
    'disabled' => 'La activación está deshabilitada.',

    'email' => [
        'line' => 'Está recibiendo este correo electrónico porque recibimos una solicitud de activación para su cuenta.',
        'action' => 'Activa tu cuenta',
        'notRequested' => 'Si no solicitó una activación, no se requiere ninguna otra acción.',
    ],

];
