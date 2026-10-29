<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'email', 'phone', 'topic', 'message', 'read_at'])]
class Enquiry extends Model
{
    protected function casts(): array
    {
        return ['read_at' => 'datetime'];
    }
}
