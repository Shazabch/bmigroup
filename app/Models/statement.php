<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class statement extends Model
{
    use HasFactory;
    protected $dates = ['statement_date'];
    public function user(){
        return $this->belongsTo(User::class)->withDefault();
    }
}
