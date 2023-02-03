<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingModel extends Model
{
    use HasFactory;

    public $table = 'bookings';
    
    public $primaryKey = 'id_booking';

    public $fillable = [
        'booking_name',
        'booking_start',
        'booking_end',
        'booking_details',
    ];

    public $timestamps = false;
}
