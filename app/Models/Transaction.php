<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_number',
        'invoice_id',
        'customer_id',
        'amount',
        'payment_method',
        'payment_date',
        'status',
        'stripe_payment_id',
        'notes',
    ];

    protected $casts = [
        'payment_date' => 'date',
    ];

    // Relationship: Transaction belongs to Invoice
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    // Relationship: Transaction belongs to Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
