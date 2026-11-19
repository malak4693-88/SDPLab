<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Authenticatable
{
    use HasApiTokens, HasFactory;

    protected $fillable = [
        'name',
        'phone_number',
        'password',
        'balance',
        'address',
    ];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'balance' => 'integer',
        ];
    }


    public function books()
    {
        return $this->belongsToMany(Book::class, 'borrowings')
            ->withPivot('borrowing_date', 'return_date', 'is_returned')
            ->withTimestamps();
    }


}