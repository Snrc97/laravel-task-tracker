<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class TaskModel extends ModelBase
{
    use HasFactory;

    protected $table = 'tasks';

    protected $fillable = [
        'project_id',
        'title',
        'status',

    ];

    public function casts(): array
    {
        return [
            'project_id' => 'integer',
            'title' => 'string',
            'status' => 'string',
        ];
    }

    public static function rules(): array
    {
        return [
            'project_id' => 'required|integer|exists:projects,id',
            'title' => 'required|string|max:255',
            'status' => 'required|string|in:todo,done',
        ];
    }

    public function project()
    {
        return $this->belongsTo(ProjectModel::class, 'project_id', 'id');
    }

}
