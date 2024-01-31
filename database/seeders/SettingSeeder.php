<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingSeeder extends Seeder
{
    protected $setting_data = [
        ['name'=>'site_title','value'=>'Laravel Base'],
        ['name'=>'currency_code','value'=>'BDT'],
        ['name'=>'currency_symbol','value'=>'Tk'],
        ['name'=>'currency_direction','value'=>'right'],
        ['name'=>'site_logo','value'=>''],
        ['name'=>'site_favicon','value'=>''],

        ['name'=>'mail_mailer','value'=>'smtp'],
        ['name'=>'mail_host','value'=>''],
        ['name'=>'mail_port','value'=>''],
        ['name'=>'mail_username','value'=>''],
        ['name'=>'mail_password','value'=>''],
        ['name'=>'mail_encryption','value'=>''],
        ['name'=>'mail_from_address','value'=>''],
        ['name'=>'mail_from_name','value'=>''],
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::insert($this->setting_data);
    }
}
