<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Te7aHoudini\LaravelTrix\Traits\HasTrixRichText;

class Page extends Model
{
    use HasFactory;
    use HasTrixRichText;

    protected $guarded = [];
}
