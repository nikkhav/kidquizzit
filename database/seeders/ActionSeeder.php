<?php

namespace Database\Seeders;

use App\Models\Actions;

use Illuminate\Database\Seeder;

class ActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $actions = [
            [
                'name'  => 'Tapşırıq əlavə etdi',
            ],
            [
                'name'  => 'Qoşma əlavə etdi',
            ],
            [
                'name'  => 'Qoşmanı sildi',
            ],
            [
                'name'  => 'Təhkim edildi',
            ],
            [
                'name'  => 'Təhkimlikdən silindi',
            ],
            [
                'name'  => 'Statusu dəyişildi',
            ],
            [
                'name'  => 'Vaciblik dəyişildi',
            ],
            [
                'name'  => 'Şərh əlavə etdi',
            ],
            [
                'name'  => 'Müştəri dəyişildi',
            ],
            [
                'name'  => 'Departament dəyişildi',
            ],
            [
                'name'  => 'Başlıq dəyişildi',
            ],
            [
                'name'  => 'Açıqlama dəyişildi',
            ],
            [
                'name'  => 'Start tarixi dəyişildi',
            ],
            [
                'name'  => 'Son möhlət dəyişildi',
            ],
            [
                'name'  => 'Çeklist dəyişildi',
            ],
            [
                'name'  => 'Çeklist əlavə etdi',
            ],
            [
                'name'  => 'Çeklist silindi',
            ],
            [
                'name'  => 'Çeklist statusu dəyişildi',
            ],
        ];
        foreach ($actions as $action) {
            Actions::create([
                'name'  => $action['name'],
            ]);
        }
    }
}
