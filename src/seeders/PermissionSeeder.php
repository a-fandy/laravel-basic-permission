<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $routeCollection = Route::getRoutes();
        $child = array();
        foreach ($routeCollection as $value) {
            if(!empty($value->getName())){
                $id = DB::table('permissions')->insertGetId([
                    'name' => $value->getName(),
                    'type' => 2,
                    'action' => $value->getActionName(),
                ]);
                array_push($child,$id);
            }
          
        }

        DB::table('permissions')->insert([
            'name' => 'superadmin',
            'type' => '1',
            'description' => 'superadmin',
            'child' => json_encode($child),
        ]);

    }
}

