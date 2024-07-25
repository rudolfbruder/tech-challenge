<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    use HasFactory;

    protected $guarded = [];
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

    public function journals(): HasMany
    {
        return $this->hasMany(Journal::class);
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
