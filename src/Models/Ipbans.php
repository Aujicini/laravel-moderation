<?php

namespace Aujicini\Moderation\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Ipbans extends Model
{
    /** @var string $fillable The attributes that are mass assignable. */
    protected $fillable = [
        'user_id',
    ]

    /** @var string $table The table associated with the model. */
    protected $table = 'ipbans';

    /**
     * Get the user that owns the ipban.
     *
     * @return mixed Returns the relationship.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
