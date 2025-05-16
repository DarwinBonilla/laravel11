<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroSoporte extends Model
{
    use HasFactory;

    protected $table = 'cacmq_registro_soporte'; // Nombre de la tabla
    protected $fillable = [
        'reg_sop_usuario',
        'reg_sop_grupo',
        'reg_sop_tecnico',
        'reg_sop_fecha',
        'reg_sop_tipo_equipo',
        'reg_sop_detalle',
        'reg_sop_falla',
        'reg_sop_asistencia',
        'reg_sop_satisfaccion'
    ]; // Campos que se pueden llenar
    public $timestamps = false;
    protected $primaryKey = 'reg_sop_id'; // Especifica la clave primaria
       public $incrementing = false; // Si no es auto-incremental
}