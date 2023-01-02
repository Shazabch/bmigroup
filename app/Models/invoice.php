<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class invoice extends Model
{
    use HasFactory;
    protected $dates= ['date','invoice_date'];
    protected $fillable =[
        'customer_no',
        'user_id',
        'invoiceId',
        'invoice_date',
        'po_no',
        'do_no',
        'date',
        'invoice_doc',
        'amount'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function payment(){
        return $this->hasOne(payment::class)->latest();
    }
    public function deliveryOrder(){
        return $this->hasOne(DeliveryOrder::class)->latest();
    }

    public static function getInvoice(){
        $records = DB::table('invoices')->select('id','date','invoiceId','invoice_doc','amount')->get()->toArray();
        return $records;
    }

    public function payments()
    {
        return $this->belongsToMany(Payment::class, 'payment_invoices');
    }
}
    