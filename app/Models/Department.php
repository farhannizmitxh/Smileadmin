<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments'; // pastikan tabelnya benar

    protected $fillable = ['name'];

    public function subDepartments()
    {
        return $this->hasMany(SubDepartment::class, 'department_id');
    }
}
