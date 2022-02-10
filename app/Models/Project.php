<?php

namespace App\Models;

use App\Models\User;
use App\Models\Academy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function academies()
    {
        return $this->belongsToMany(Academy::class, 'project_academy', 'project_id', 'academy_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_project', 'user_id', 'project_id');
    }
}
