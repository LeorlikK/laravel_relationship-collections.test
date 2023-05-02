<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OneToManyFirst extends Model
{
    use HasFactory;

    protected $table = 'one_to_many_first';
    protected $guarded = [];
    protected $primaryKey = 'primary_first';

    public function second():HasMany
    {
        return $this->hasMany(OneToManySecond::class, 'first_id', 'primary_first');
    }
}
