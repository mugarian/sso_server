<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Passport\Client;
use Illuminate\Database\Eloquent\Model;

class Passport extends Client
{
    // use HasFactory;
    public function skipsAuthorization()
    {
        return false;
    }
}
