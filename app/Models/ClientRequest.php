<?php

namespace App\Models;

class ClientRequest
{

    const STATUS_QUEUE = 'queue';
    const STATUS_SENT = 'sent';
    const STATUS_EXECUTED = 'executed';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description',
        'user_id',
        'vendor_id',
        'status',
        'payment_status',
        'payment_id'
    ];

    /**
     * Get the client associated with the request.
     */
    public function client()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * Get the vendor associated with the request.
     */
    public function vendor()
    {
        return $this->belongsTo('App\User', 'vendor_id');
    }
}
