<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory,SoftDeletes;

    protected $dateFormat = "U";

    protected $fillable =[
        'title',
        'description',
        'start_date',
        'end_date',
        'vip_ticket_price',
        'regular_ticket_price',
        'max_attendees',
        'creator_id'
    ];
}
