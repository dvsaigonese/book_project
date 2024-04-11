<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $positions = [
            [
                'name' => 'admin'
            ],
            [
                'name' => 'user'
            ]
        ];

        foreach ($positions as $position) {
            \App\Models\Role::create($position);
        }
    }
}
