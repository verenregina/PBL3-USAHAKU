<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DatasetUmkmImport;

class DatasetUmkmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Excel::import(
            new DatasetUmkmImport,
            storage_path('app/public/dataset_umkm_01.xlsx')
        );
    }
}
