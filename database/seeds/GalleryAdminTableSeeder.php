<?php

use Illuminate\Database\Seeder;
use OrlandoLibardi\PageCms\app\Page;
use OrlandoLibardi\OlCms\AdminCms\app\Admin;

class MenuAdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {               
        $gallery =  Admin::create([
                        'name' => 'Galerias',
                        'route' => 'gallery.index',
                        'icon' => 'fa fa-picture-o',
                        'parent_id' => 0,
                        'minimun_can' => 'list',
                        'order_at' => 3
                    ]);     
        /* Gallery list */
        Admin::create([
            'name' => 'Cadastradas',
            'route' => 'gallery.index',
            'icon' => '',
            'parent_id' => $gallery->id,
            'minimun_can' => 'list',
            'order_at' => 1
        ]); 
         /* Gallery templates list */    
        Admin::create([
            'name' => 'Templates',
            'route' => 'gallery-template.index',
            'icon' => '',
            'parent_id' => $gallery->id,
            'minimun_can' => 'config',
            'order_at' => 1
        ]);                

    }
}

