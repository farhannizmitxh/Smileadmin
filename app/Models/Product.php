<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products'; // sesuai nama migration

    protected $fillable = [
        'id',
        'name',
        'price',
        'image',
        'main_category',
        'department',
        'sub_department',
        'stock',
    ];

    public function departements()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
    
    public function subDepartements()
    {
        return $this->belongsTo(SubDepartment::class, 'sub_department_id');
    }
}
