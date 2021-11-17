<?php

namespace Database\Seeders;

use App\Models\Companies\Company;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class AdminsSeeder extends Seeder
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
                'email' => 'admin@facilesolution.com',
                'password' => Hash::make('azertyui'),
                'is_admin'    => true,
            ],
        ];
        
        $permissions = Permission::all();

        foreach ($data as $row) {
            $user = User::firstOrCreate($row);
            
            foreach ($permissions as $permission) {
                if ($user && $permission) {
                    $user->givePermissionTo($permission);
                }
            }
        }
    }
}
