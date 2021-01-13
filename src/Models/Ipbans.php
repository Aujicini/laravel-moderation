<?php

namespace Aujicini\Moderation\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Ipbans extends Model
{
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
