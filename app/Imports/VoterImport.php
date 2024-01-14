<?php

namespace App\Imports;

use App\Models\BatchUser;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class VoterImport implements ToModel, WithStartRow
{

    public function startRow(): int
    {
        return 2;
    }

    public function model(array $row)
    {
        $username = strtolower(explode(' ', $row[0])[0] . '_' . substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 4)) . '_' . $row[1];
        $password = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 4) . substr(str_shuffle('0123456789'), 0, 4);
        $roleUser = Role::where('name', 'user')->first();
        $user = User::create([
            'name' => $row[0],
            'username' => $username,
            'password' => bcrypt($password),
            'access_password' => $password,
        ]);

        $user->attachRole($roleUser);

        BatchUser::create([
            'user_id' => $user->id,
            'batch_id' => $row[1],
        ]);
    }
}
