<?php

use Illuminate\Database\Seeder;
use App\Booking;
use Faker\Generator as Faker;

class BookingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 5; $i++) {

            $newBooking = new Booking();
            $newBooking->nome = $faker->name();
            $newBooking->posti = rand(1, 4);
            $newBooking->giorno_prenotazione = $faker->date();
            $newBooking->orario = $faker->time();
            $newBooking->save();
        }
    }
}
