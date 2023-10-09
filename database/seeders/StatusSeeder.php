<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            [
                'name'  => 'Yeni',
                'color' => 'info'
            ],
            [
                'name'  => 'Davam edir',
                'color' => 'warning'
            ],
            [
                'name'  => 'Gözləmədə',
                'color' => 'success'
            ],
            [
                'name'  => 'Tamamlandi',
                'color' => 'primary'
            ],
        ];

        foreach($statuses as $status){
            Status::create([
                'name'  => $status['name'],
                'color' => $status['color'],
            ]);
        }
       
    }
}
