<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'street_number','state','country','street_name',
        'city','post_code'

    ];


    public function user(){
        return $this->belongsTo(User::class);
    }
}
