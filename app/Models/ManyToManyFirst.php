<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ManyToManyFirst extends Model
{
    use HasFactory;

    protected $table = 'many_to_many_first';
    protected $guarded = [];
    protected $primaryKey = 'primary_first';

    public function second():BelongsToMany
    {
        return $this->belongsToMany(ManyToManySecond::class, 'many_to_many_interim', 'many_first_interim', 'many_second_interim');
    }
}
