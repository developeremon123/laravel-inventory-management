<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ModuleSeeder extends Seeder
{
    protected $data = [
        ['menu_id' => 1, 'type' => 1, 'module_name' => null, 'divider_title' => 'Menus', 'icon_class' => null, 'url' => null, 'order' => 1, 'parent_id' => null],
        ['menu_id' => 1, 'type' => 2, 'module_name' => 'Dashboard', 'divider_title' => null, 'icon_class' => 'fa-solid fa-gauge-simple-high', 'url' => '/', 'order' => 2, 'parent_id' => null],
        ['menu_id' => 1, 'type' => 1, 'module_name' => null, 'divider_title' => 'System', 'icon_class' => null, 'url' => null, 'order' => 3, 'parent_id' => null],
        ['menu_id' => 1, 'type' => 2, 'module_name' => 'Menu', 'divider_title' => null, 'icon_class' => 'fa-solid fa-list', 'url' => '/menu', 'order' => 4, 'parent_id' => null],
        ['menu_id' => 1, 'type' => 2, 'module_name' => 'Setting', 'divider_title' => null, 'icon_class' => 'fa-solid fa-gear', 'url' => '/setting', 'order' => 5, 'parent_id' => null],
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Module::insert($this->data);
    }
}
