<?php

namespace Database\Seeders;

use App\Models\ProfileCompany;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProfileCompany::create([
            'phone' => '08123456789',
            'terms' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.',
            'latitude' => '-6.7158898',
            'longitude' => '108.5483058',
            'radius' => '100',
            'conditions' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.',
        ]);
    }
}