<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithValidation;
use Throwable;

class ImportUsers implements ToModel, WithHeadingRow, WithCalculatedFormulas
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $bin = User::get();
        $bin_email = $bin->pluck('email');

        if ($bin_email->contains($row['email']) == false) {
            return new User([
                'name' => $row['name'],
                'email' => $row['email'],
                'password' => \Hash::make($row['password']),
                'username' => $row['username'],
                'roles' => $row['roles'],
                'alamat' => $row['alamat'],
                'nomor_induk' => $row['nomor_induk'],
                'phone' => $row['phone'],
                'tempat_lahir' => $row['tempat_lahir'],
                // dd($row['tanggal_lahir']),
                'tanggal_lahir' => Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal_lahir'])),
                'level' => $row['level'],
                'skor' => $row['skor'],
                'exp' => $row['exp'],
                'gender' => $row['gender'],
                'avatar' => $row['avatar'],
                'background' => $row['background'],
                'created_at' => new \DateTime,
                'updated_at' => null,
                'status' => $row['status'],
            ]);
        } else {
            null;
        }
    }

    // public function onError(Throwable $error){

    // }

    // public function rules(): array
    // {
    //     return [
    //         'email' => 'unique:users,email'
    //     ];
    // }

}
