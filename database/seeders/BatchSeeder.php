<?php

namespace Database\Seeders;

use App\Models\Batch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Batch 1',
                'description' => 'Batch 1',
                'start' => '2021-01-01 08:00:00',
                'finish' => '2021-01-01 14:00:00',
            ],
            [
                'name' => 'Batch 2',
                'description' => 'Batch 2',
                'start' => '2021-01-01 14:00:00',
                'finish' => '2021-01-01 21:00:00',
            ],
            [
                'name' => 'Batch 3',
                'description' => 'Batch 3',
                'start' => '2021-01-01 08:00:00',
                'finish' => '2021-01-01 14:00:00',
            ],
            [
                'name' => 'Batch 4',
                'description' => 'Batch 4',
                'start' => '2021-01-01 14:00:00',
                'finish' => '2021-01-01 21:00:00',
            ],
            [
                'name' => 'Batch 5',
                'description' => 'Batch 5',
                'start' => '2021-01-01 08:00:00',
                'finish' => '2021-01-01 14:00:00',
            ],
            [
                'name' => 'Batch 6',
                'description' => 'Batch 6',
                'start' => '2021-01-01 14:00:00',
                'finish' => '2021-01-01 21:00:00',
            ],
            [
                'name' => 'Dev Batch 7',
                'description' => 'Batch 7',
                'start' => '2021-01-01 08:00:00',
                'finish' => '2021-01-01 14:00:00',
            ],
            [
                'name' => 'Dev Batch 8',
                'description' => 'Batch 8',
                'start' => '2021-01-01 14:00:00',
                'finish' => '2021-01-01 21:00:00',
            ]
        ];
        foreach ($data as $item) {
            Batch::create($item);
        }
    }
}
