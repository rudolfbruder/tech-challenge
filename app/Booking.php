<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $dates = [
        'start',
        'end',
    ];

    public function getTimeAttribute()
    {
        if (Carbon::parse($this->start)->isSameDay(Carbon::parse($this->end))) {
            return Carbon::parse($this->start)->format('l d F Y, H:m') . ' to ' . Carbon::parse($this->end)->format('H:m');

        }

        return $this->start->format('l d F Y, H:m') . ' to ' . $this->end->format('l d F Y, H:m');
    }
}
