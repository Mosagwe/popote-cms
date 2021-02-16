<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryRecords =[
['id'=>1,'parent_id'=>0,'section_id'=>1,'category_name'=>'T-shirts','category_discount'=>0,
'description'=>'','url'=>'t-shirts','meta_description'=>'','meta_title'=>'', 'category_image'=>'','meta_keywords'=>1,'status'=>1
        ],
        ['id'=>2,'parent_id'=>1,'section_id'=>1,'category_name'=>'Casual T-shirts','category_discount'=>0,
'description'=>'','url'=>'casual-t-shirts','meta_description'=>'','meta_title'=>'','meta_keywords'=>1,'category_image'=>'','status'=>1
    ],
        ];

        Category::insert($categoryRecords);
    }
}
