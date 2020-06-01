<?php

namespace App;

use App\Casts\StatusCast;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Todo
 * @package App
 *
 * @property-read $id
 * @property $title
 * @property $description
 * @property boolean $done
 * @property $user_id
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 * @property User $user
 * @property $status
 */

class Todo extends Model
{
    protected $fillable = [
        'title', 'description', 'done', 'user_id', 'status'
    ];

    protected $casts = [
        'done' => 'boolean',
        'status' => StatusCast::class
    ];

    function isComplete() {
        return $this->done;
    }

    function user() {
        return $this->belongsTo(User::class);
    }
}
