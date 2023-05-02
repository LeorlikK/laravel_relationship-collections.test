<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OneToOneSecond extends Model
{
    use HasFactory;

    protected $table = 'one_to_one_second';
    protected $guarded = [];
    protected $primaryKey = 'primary_second';


    public function first():BelongsTo
    {
        return $this->belongsTo(OneToOneFirst::class, 'first_id', 'primary_first');
    }
}
