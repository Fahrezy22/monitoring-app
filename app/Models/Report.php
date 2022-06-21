<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = 'reports';
    protected $fillable = [
        'id_project',
        'tittle',
        'percentage',
        'description',
        'date',
        'minus',
        'status',
    ];

    public function project_rol()
    {
        return $this->belongsTo(Project::class, 'id_project');
    }
}
