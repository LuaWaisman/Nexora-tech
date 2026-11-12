<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Solicitud extends Model
{
    protected $table = 'solicitudes';

    protected $primaryKey = 'id_solicitud';

    public $timestamps = false;

    protected $fillable = [
        'id_solicitante',
        'asunto',
        'descripcion',
        'tipo',
        'estado',
    ];

    protected function casts(): array
    {
        return [
            'id_solicitante' => 'integer',
            'fecha_creacion' => 'datetime',
        ];
    }

    public function solicitante(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_solicitante', 'id');
    }
}
