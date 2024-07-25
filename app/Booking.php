<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'client_id',
        'start',
        'end',
        'notes',
    ];

    protected $dates = [
        'start',
        'end',
    ];

    public function getTimeAttribute()
    {
        if (Carbon::parse($this->start)->isSameDay(Carbon::parse($this->end))) {
            return $this->start->format('l d F Y, H:m') . ' to ' . $this->end->format('H:m');

        }

        return $this->start->format('l d F Y, H:m') . ' to ' . $this->end->format('l d F Y, H:m');
    }
}
