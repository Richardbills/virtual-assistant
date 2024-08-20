<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Group::updateOrCreate(['group' => '-']);
        Group::updateOrCreate(['group' => 'General Depression']);
        Group::updateOrCreate(['group' => 'Postnatal Depression']);
        Group::updateOrCreate(['group' => 'Psychotic Depression']);
    }
}
