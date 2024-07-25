<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Client extends Model
{
    //I am a fan of setting $guaded to = [] via stub when making a model by artisan
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'city',
        'postcode',
    ];

    protected $appends = [
        'url',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function bookingsOrderByNewest()
    {
        return $this->hasMany(Booking::class)->orderByDesc('start');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    //Scopes

    public function getBookingsCountAttribute()
    {
        return $this->bookings->count();
    }

    public function getUrlAttribute()
    {
        return "/clients/" . $this->id;
    }

    //methods
    public function canBeDeletedByUser(): bool
    {
        return $this->user_id == auth()->user()?->id;
    }
}
