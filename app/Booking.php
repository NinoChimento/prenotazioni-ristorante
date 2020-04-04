<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        "nome",
        "posti",
        "giorno_prenotazione",
        "orario"
    ];
}
