<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected  $fillable= [
        'user_id','order_id','title',
        'message','status','ticket_type_id',
    ];
    public function ticketType(){
        return $this->belongsTo(TicketType::class) ;
    }
    public function customer(){
        return $this->belongsTo(User::class,'user_id','id') ;
    }
    public function order(){
        return $this->belongsTo(Order::class) ;
    }
}
