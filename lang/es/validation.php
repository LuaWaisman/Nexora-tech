<?php

return [
    'required' => 'El campo :attribute es obligatorio.',
    'email' => 'El campo :attribute debe ser un correo válido.',
    'string' => 'El campo :attribute debe ser texto.',
    'in' => 'El valor de :attribute no es válido.',
    'confirmed' => 'La confirmación de :attribute no coincide.',
    'different' => 'El campo :attribute debe ser distinto de :other.',
    'current_password' => 'La contraseña actual es incorrecta.',
    'max' => [
        'string' => 'El campo :attribute no puede superar los :max caracteres.',
    ],
    'min' => [
        'string' => 'El campo :attribute debe tener al menos :min caracteres.',
    ],
    'attributes' => [
        'email' => 'correo electrónico',
        'password' => 'contraseña',
        'current_password' => 'contraseña actual',
        'asunto' => 'asunto',
        'descripcion' => 'descripción',
        'tipo' => 'tipo de problema',
        'estado' => 'estado',
    ],
];
