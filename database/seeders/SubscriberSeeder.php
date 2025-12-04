<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subscriber;

class SubscriberSeeder extends Seeder
{
    public function run()
    {
        Subscriber::create([
            'name' => 'Roxy',
            'phone_number' => '+12817012625'
        ]);
    }
}