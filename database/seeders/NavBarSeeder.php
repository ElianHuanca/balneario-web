<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NavBar;


class NavBarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $links = [
            [
                'name' => 'Personas',
                'route' => 'personas.index',
                'ordering' => 1
            ],
            [
                'name' => 'Activos',
                'route' => 'activos.index',
                'ordering' => 2
            ],
            [
                'name' => 'Categorías',
                'route' => 'categorias.index',
                'ordering' => 3
            ],
            [
                'name' => 'Usuarios',
                'route' => 'usuarios.index',
                'ordering' => 4
            ],
            [
                'name' => 'Ambientes',
                'route' => 'ambientes.index',
                'ordering' => 5
            ],
            [
                'name' => 'Ubicaciones',
                'route' => 'ubicaciones.index',
                'ordering' => 6
            ],
            [
                'name' => 'Traslados',
                'route' => 'traslados.index',
                'ordering' => 7
            ],
            [
                'name' => 'Mantenimientos',
                'route' => 'mantenimientos.index',
                'ordering' => 8
            ]
        ];

        foreach ($links as $key => $navbar) {
            NavBar::create($navbar);
        }
    }
}
