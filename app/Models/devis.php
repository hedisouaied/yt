<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class devis extends Model
{
    use HasFactory;
    protected $fillable = ['nom_local', 'name', 'email', 'phone', 'content', 'date_d', 'time_d'];
}
