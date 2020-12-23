<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\Email;
use App\Models\Number;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Contact::factory()->count(45)->create()->each(function($service) {
            $service->numbers()->saveMany(Number::factory()->count(2)->make());
            $service->emails()->saveMany(Email::factory()->count(2)->make());
        });
    }
}
