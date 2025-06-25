<?php

namespace App\Models;

class ProjectModel extends ModelBase
{
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
}
