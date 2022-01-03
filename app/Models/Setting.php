<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int suggestion_frequency
 * @property int max_count
 */

class Setting extends Model
{
    use HasFactory;
}
