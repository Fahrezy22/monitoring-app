<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';
    protected $fillable = [
        'project_name',
        'percentage',
        'address',
        'status',
        'id_user',
        'id_daerah',
    ];

    public function daerah_rol()
    {
        return $this->belongsTo(Daerah::class, 'id_daerah');
    }

    public function user_rol()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
