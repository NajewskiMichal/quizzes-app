<?php

return [
    'required' => 'To pole jest wymagane.',
    'string' => 'To pole musi być tekstem.',
    'max' => [
        'string' => 'To pole nie może mieć więcej niż :max znaków.',
    ],
    'nullable' => 'To pole może być puste.',
    'email' => 'To pole musi zawierać poprawny adres e-mail.',
    'unique' => 'Ten :attribute jest już zajęty.',
    'numeric' => 'To pole musi być liczbą.',
    'date' => 'To pole musi być datą.',
    'between' => [
        'numeric' => 'Wartość musi być pomiędzy :min a :max.',
        'string' => 'Długość musi być pomiędzy :min a :max znaków.',
    ],
    'confirmed' => 'Potwierdzenie nie pasuje.',
];
