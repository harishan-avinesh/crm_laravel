<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number',
        'title',
        'description',
        'amount',
        'status',
        'customer_id',
        'due_date',
    ];

    protected $casts = [
        'due_date' => 'date',
    ];

    // Relationship: Invoice belongs to Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Relationship: Invoice has many Transactions
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    // Helper method to check if invoice is fully paid
    public function isPaid()
    {
        return $this->transactions()->where('status', 'success')->sum('amount') >= $this->amount;
    }
}
