<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Task extends Model
{
    use SoftDeletes, HasFactory;

    // Definir qué atributos son asignables masivamente
    protected $fillable = ['title', 'description', 'user_id'];

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

}
