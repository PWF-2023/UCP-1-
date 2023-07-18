<?php

namespace Database\Factories;

use App\Models\Kandidat;
use Illuminate\Database\Eloquent\Factories\Factory;

class KandidatFactory extends Factory
{
    protected $model = Kandidat::class;

    public function definition()
    {
        return [
            'nama' => $this->faker->name,
            'partai' => $this->faker->company,
            'foto_partai' => 'path/to/photo.jpg',
        ];
    }
}
