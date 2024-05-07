<?php

namespace Database\Seeders;

use App\Models\Classe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClasseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!Classe::where('name', 'Aula 1')->first()) {
            Classe::create([
                'name' => 'Aula 1',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos expedita unde quam eaque, voluptatum, quidem nemo obcaecati voluptatem officiis voluptas vero exercitationem, molestiae cumque quasi nam praesentium similique facere soluta.',
                'course_id' => 4,

            ]);
        }

        if (!Classe::where('name', 'Aula 2')->first()) {
            Classe::create([
                'name' => 'Aula 2',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos expedita unde quam eaque, voluptatum, quidem nemo obcaecati voluptatem officiis voluptas vero exercitationem, molestiae cumque quasi nam praesentium similique facere soluta.',
                'course_id' => 4,
            ]);
        }

        if (!Classe::where('name', 'Aula 1B')->first()) {
            Classe::create([
                'name' => 'Aula 1B',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos expedita unde quam eaque, voluptatum, quidem nemo obcaecati voluptatem officiis voluptas vero exercitationem, molestiae cumque quasi nam praesentium similique facere soluta.',
                'course_id' => 5,

            ]);
        }
    }
}
