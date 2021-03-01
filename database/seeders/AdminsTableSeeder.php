<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('admins')->delete();
        $adminRecords=[[
'id'=>1,'name'=>'admin','type'=>'admin','mobile'=>'0728333742','email'=>'admin@gmail.com',
'password'=>'$2y$10$WfdSxJVe30c1YnonkSyh9Orp4jY/y9BS5ws3Be5u/c0k6NdETI1We','image'=>'','status'=>1
        ],
    ];
  
    foreach ($adminRecords as $key =>$record){
\App\Models\Admin::create($record);
    }
 $admins= DB::table('admins')->insert($adminRecords);

    }
}
