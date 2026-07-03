<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        $cities = [
            'Bogotá', 'Medellín', 'Cali', 'Cartagena', 'Cúcuta', 'Bucaramanga',
            'Pereira', 'Santa Marta', 'Ibagué', 'Manizales', 'Villavicencio',
            'Neiva', 'Pasto', 'Montería', 'Armenia', 'Sincelejo', 'Popayán',
            'Valledupar', 'Tunja', 'Florencia', 'Riohacha', 'Yopal', 'Quibdó',
            'Leticia', 'San Andrés', 'Arauca', 'Mitú', 'Inírida',
            'Puerto Carreño', 'Mocoa', 'Puerto Asís', 'Tumaco', 'Buenaventura',
            'Apartadó', 'Floridablanca', 'Girón', 'Rionegro', 'Envigado',
            'Itagüí', 'La Ceja', 'La Estrella', 'Sabaneta',
        ];

        foreach ($cities as $name) {
            City::create(['name' => $name]);
        }
    }
}