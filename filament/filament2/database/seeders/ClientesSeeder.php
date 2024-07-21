<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    // public function run(): void
    // {
    //     DB::table('clientes')->insert([
    //         ['nombre' => 'Cliente 1', 'latitud' => 40.416775, 'longitud' => -3.703790],
    //         ['nombre' => 'Cliente 2', 'latitud' => 41.387917, 'longitud' => 2.169919],
    //         ['nombre' => 'Cliente 3', 'latitud' => 37.389092, 'longitud' => -5.984459],
    //         ['nombre' => 'Cliente 4', 'latitud' => 39.469907, 'longitud' => -0.376288],
    //         ['nombre' => 'Cliente 5', 'latitud' => 36.721274, 'longitud' => -4.421399],
    //         ['nombre' => 'Cliente 6', 'latitud' => 37.992240, 'longitud' => -1.130654],
    //         ['nombre' => 'Cliente 7', 'latitud' => 43.263013, 'longitud' => -2.934985],
    //         ['nombre' => 'Cliente 8', 'latitud' => 39.862831, 'longitud' => 4.028092],
    //         ['nombre' => 'Cliente 9', 'latitud' => 38.345170, 'longitud' => -0.481490],
    //         ['nombre' => 'Cliente 10', 'latitud' => 40.965157, 'longitud' => -5.664018],
    //         ['nombre' => 'Cliente 11', 'latitud' => 37.983445, 'longitud' => -1.128805],
    //         ['nombre' => 'Cliente 12', 'latitud' => 36.140751, 'longitud' => -5.353585],
    //         ['nombre' => 'Cliente 13', 'latitud' => 41.656059, 'longitud' => -0.877341],
    //         ['nombre' => 'Cliente 14', 'latitud' => 42.846718, 'longitud' => -2.673059],
    //         ['nombre' => 'Cliente 15', 'latitud' => 39.569600, 'longitud' => 2.650160],
    //         ['nombre' => 'Cliente 16', 'latitud' => 43.532201, 'longitud' => -5.661120],
    //         ['nombre' => 'Cliente 17', 'latitud' => 28.123545, 'longitud' => -15.436257],
    //         ['nombre' => 'Cliente 18', 'latitud' => 37.177336, 'longitud' => -3.598557],
    //         ['nombre' => 'Cliente 19', 'latitud' => 40.971056, 'longitud' => -5.663539],
    //         ['nombre' => 'Cliente 20', 'latitud' => 43.012527, 'longitud' => -7.555482]
    //     ]);
    // }
    public function run()
    {
        $clientes = [];
        for ($i = 1; $i <= 500; $i++) {
            $clientes[] = [
                'nombre' => 'Cliente ' . $i,
                'latitud' => $this->generateRandomLatitude(),
                'longitud' => $this->generateRandomLongitude(),
            ];
        }

        DB::table('clientes')->insert($clientes);
    }

    private function generateRandomLatitude()
    {
        // Coordenadas aproximadas de España: latitud entre 36.0 y 43.7
        return round(36.0 + mt_rand() / mt_getrandmax() * (43.7 - 36.0), 6);
    }

    private function generateRandomLongitude()
    {
        // Coordenadas aproximadas de España: longitud entre -9.3 y 3.3
        return round(-9.3 + mt_rand() / mt_getrandmax() * (3.3 - (-9.3)), 6);
    }
}
