<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class InsertCategories extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name' => 'Vertedero improvisado',
                'icon' => 'fi fi-rr-trash'
            ],
            [
                'name' => 'Parque descuidado',
                'icon' => 'fi fi-rr-bench-tree'
            ],
            [
                'name' => 'Calle en mal estado',
                'icon' => 'fi fi-rr-road'
            ],
            [
                'name' => 'Acera en mal estado',
                'icon' => 'fi fi-rr-slash'
            ],
            [
                'name' => 'Lampara averiada',
                'icon' => 'fi fi-rr-lightbulb-slash'
            ],
            [
                'name' => 'Semáfoto averiado',
                'icon' => 'fi fi-rr-traffic-light'
            ],
            [
                'name' => 'Señalización en mal estado',
                'icon' => 'fi fi-rr-sign-hanging'
            ],
            [
                'name' => 'Inundación',
                'icon' => 'fi fi-rr-house-flood'
            ],
            [
                'name' => 'Monumento en mal estado',
                'icon' => 'fi fi-rr-landmark-alt'
            ],
            [
                'name' => 'Árbol en mal estado',
                'icon' => 'fi fi-rr-tree'
            ],
            [
                'name' => 'Tráfico congestionado',
                'icon' => 'fi fi-rr-cars'
            ],
            [
                'name' => 'Zona deportiva descuidada',
                'icon' => 'fi fi-rr-baseball-alt'
            ],
        ];

        foreach ($categories as $category) {
            $this->db->table('categories')->insert($category);
        }
    }
}
