<?php

namespace Database\Factories;

use App\Models\Articulo;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticuloFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Articulo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
           //Instrucciones con que datos se va a insertar cada campo
           'nombre' => $this->faker->name,
           'descripcion' => $this->faker->unique()->paragraph(),
           'stock' => $this->faker->unique()->numberBetween(1,999),
        ];
    }
}
