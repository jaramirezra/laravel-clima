<?php
/**
 * Translation file for the forms section.
 * Contains translations of texts related to the city registration form.
 */

return [
    'forms' => [
        'title' => 'Registration Form',
        'select-city' => 'Select a city',
        'latitude' => 'Latitude',
        'length' => 'Longitude',
        'image' => 'City Image',
    ],
    'validation' => [
        'alert' => 'Review the highlighted fields before saving.',
        'latitude_required' => 'Latitude is required.',
        'latitude_decimal' => 'Latitude must be a valid decimal number with up to 7 decimal places.',
        'latitude_range' => 'Latitude must be between -90 and 90.',
        'length_required' => 'Longitude is required.',
        'length_decimal' => 'Longitude must be a valid decimal number with up to 7 decimal places.',
        'length_range' => 'Longitude must be between -180 and 180.',
    ],
    'alerts' => [
        'success_title' => 'Saved successfully',
        'error_title' => 'Could not save',
        'confirm' => 'OK',
    ]
];
