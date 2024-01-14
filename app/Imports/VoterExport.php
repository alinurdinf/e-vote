<?php

namespace App\Imports;

use App\Models\BatchUser;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class VoterExport implements FromCollection, WithHeadings, WithMapping, WithTitle
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return BatchUser::with('user', 'batch')->get();
    }
    public function headings(): array
    {
        return [
            'Nama',
            'Username',
            'Password',
            'Batch',
            'Waktu Pemilihan',

        ];
    }
    public function map($row): array
    {
        return [
            $row->user->name,
            $row->user->username,
            $row->user->access_password,
            $row->batch->name,
            $row->batch->start . ' - ' . $row->batch->finish,
        ];
    }
    public function title(): string
    {
        return 'Generate By E-Vote Branch Of Foskomi Portal';
    }
}
