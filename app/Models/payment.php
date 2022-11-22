<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    use HasFactory;
    protected $dates= ['due_Date','payment_date'];
    protected $fillable = [
        'due_Date',
        'payment_date',
    ];

    public function invoice(){
        return $this->belongsTo(invoice::class)->withDefault();
    }
    public function user(){
        return $this->belongsTo(User::class)->withDefault();
    }
    
    
}
