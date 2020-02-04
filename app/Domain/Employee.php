<?php

namespace App\Domain;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;

    protected $fillable = [
        "name",
        "email",
        "position",
        "office",
        "salary",
        "working_hours",
    ];

    public function __toString()
    {
        return [
            "name" => $this->name,
        ];
    }
}
