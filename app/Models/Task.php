<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /**
     * Campos que se pueden asignar en conjunto.
     */
    protected $fillable = [
        'title',
        'description',
        'priority',
        'status',
        'due_date',
    ];

    /**
     * Conversión de tipos de datos.
     */
    protected function casts(): array
    {
        return [
            'due_date' => 'date',
        ];
    }
}