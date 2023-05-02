<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ManyToManySecond extends Model
{
    use HasFactory;

    protected $table = 'many_to_many_second';
    protected $guarded = [];
    protected $primaryKey = 'primary_second';

    public function first():BelongsToMany
    {
        return $this->belongsToMany(ManyToManyFirst::class, 'many_to_many_interim', 'many_second_interim', 'many_first_interim');
    }
}
