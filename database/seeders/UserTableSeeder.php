<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    public function run(): void
    {

        try {
            DB::beginTransaction();
            $this->userCreate();
            $this->userCreateTwo();
            $this->userCreateThree();
            DB::commit();
            $this->command->info('User Successfully Created');
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->command->info($th->getMessage());
        }
    }

    public function userCreate()
    {

        $admin = new User();
        $admin->name = 'Masud M';
        $admin->email = 'masud@gmail.com';
        $admin->password = Hash::make('password');
        $admin->save();
    }
    public function userCreateTwo()
    {

        $admin = new User();
        $admin->name = 'Rana R';
        $admin->email = 'rana@gmail.com';
        $admin->password = Hash::make('password');
        $admin->save();
    }
    public function userCreateThree()
    {

        $admin = new User();
        $admin->name = 'Tapu T';
        $admin->email = 'tapu@gmail.com';
        $admin->password = Hash::make('password');
        $admin->save();
    }
}
