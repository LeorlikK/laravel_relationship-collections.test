<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OneToOneFirst extends Model
{
    use HasFactory;

    protected $table = 'one_to_one_first';
    protected $guarded = [];
    protected $primaryKey = 'primary_first';

    public function second():HasOne
    {
        return $this->hasOne(OneToOneSecond::class, 'first_id','primary_first');
    }
}
