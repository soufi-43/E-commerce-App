<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $fillable = [
       'user_id','shipment_date','order_id',
        'payment_id','status'

    ];
    public function customer(){
        return $this->belongsTo(User::class);
    }
    public function order(){
        return $this->belongsTo(Order::class);
    }
    public function payment(){
        return $this->hasOne(Payment::class);
    }
}
