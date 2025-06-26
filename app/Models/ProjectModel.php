<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProjectModel extends ModelBase
{
    use HasFactory;

    protected $table = 'projects';

    protected $fillable = [
        'user_id',
        'name'
    ];

    protected function casts(): array
    {
        return [
            'user_id' => 'integer',
            'name' => 'string',
        ];
    }

    public static function rules(): array
    {
        return [
            'user_id' => 'required|integer|exists:users,id',
            'name' => 'required|string|max:255',
        ];
    }

    public function user()
    {
        return $this->belongsTo(UserModel::class, 'user_id');
    }

    public function tasks()
    {
        return $this->hasMany(TaskModel::class, 'project_id', 'id');
    }
}
