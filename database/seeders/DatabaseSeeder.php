<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Crear un usuario de prueba
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

        // Crear perfil de cliente
        \App\Models\Cliente::create([
            'user_id' => $user->id,
            'telefono' => '123456789',
            'direccion' => 'Calle Falsa 123',
        ]);

        // Crear algunos artículos
        $articulo1 = \App\Models\Articulo::create([
            'nombre' => 'Laptop Gamer',
            'descripcion' => 'Potente laptop para juegos',
            'precio' => 1500.00,
            'stock' => 10,
        ]);

        $articulo2 = \App\Models\Articulo::create([
            'nombre' => 'Mouse Inalámbrico',
            'descripcion' => 'Mouse ergonómico',
            'precio' => 25.50,
            'stock' => 50,
        ]);

        // Crear un carrito para el usuario y añadir artículos
        $carrito = \App\Models\Carrito::create(['user_id' => $user->id]);
        $carrito->articulos()->attach($articulo1->id, ['cantidad' => 1]);
        $carrito->articulos()->attach($articulo2->id, ['cantidad' => 2]);

        // Crear una venta simulada
        $venta = \App\Models\Venta::create([
            'user_id' => $user->id,
            'total' => 1551.00,
            'estado' => 'completado',
        ]);

        // Asociar artículos a la venta
        $venta->articulos()->attach($articulo1->id, ['cantidad' => 1, 'precio' => 1500.00]);
        $venta->articulos()->attach($articulo2->id, ['cantidad' => 2, 'precio' => 25.50]);
    }
}
