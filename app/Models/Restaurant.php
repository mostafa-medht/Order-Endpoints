<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Restaurant extends Model
{
    protected $table = 'restaurants';

    protected $fillable = ['name', 'created_at', 'updated_at'];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    } //end of orders

}
