<?php

namespace App\Models;

class ProjectModel extends ModelBase
{
    protected $fillable = ['name'];

    protected function casts(): array
    {
        return [
            'name' => 'string',
        ];
    }

    public static function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
        ];
    }
}
