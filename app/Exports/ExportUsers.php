<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportUsers implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return User::select(
            'id',
            'name',
            'email',
            'username',
            'roles',
            'alamat',
            'nomor_induk',
            'phone',
            'tempat_lahir',
            'tanggal_lahir',
            'level',
            'skor',
            'exp',
            'gender',
            'avatar',
            'background',
            'status',
        )->get();
    }
    public function headings(): array
    {
        return [
            'No',
            'name',
            'email',
            'username',
            'roles',
            'alamat',
            'nomor_induk',
            'phone',
            'tempat_lahir',
            'tanggal_lahir',
            'level',
            'skor',
            'exp',
            'gender',
            'avatar',
            'background',
            'status',
        ];
    }
}
