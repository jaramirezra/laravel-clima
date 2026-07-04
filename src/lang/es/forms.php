<?php
/**
 * Archivo de traducción para la sección de formularios.
 * Contiene las traducciones de los textos relacionados con el formulario de registro de ciudades.
 */

return [
    'forms' => [
        'title' => 'Formulario de registro',
        'select-city' => 'Seleccione una ciudad',
        'latitude' => 'Latitud',
        'length' => 'Longitud',
        'image' => 'Imagen de la ciudad',
    ],
    'validation' => [
        'alert' => 'Revisa los campos marcados antes de guardar.',
        'latitude_required' => 'La latitud es obligatoria.',
        'latitude_decimal' => 'La latitud debe ser un numero decimal valido con maximo 7 decimales.',
        'latitude_range' => 'La latitud debe estar entre -90 y 90.',
        'length_required' => 'La longitud es obligatoria.',
        'length_decimal' => 'La longitud debe ser un numero decimal valido con maximo 7 decimales.',
        'length_range' => 'La longitud debe estar entre -180 y 180.',
    ],
    'alerts' => [
        'success_title' => 'Guardado correctamente',
        'error_title' => 'No se pudo guardar',
        'confirm' => 'Aceptar',
    ]
];
