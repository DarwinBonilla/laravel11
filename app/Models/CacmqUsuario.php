namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroSoporte extends Model
{
    use HasFactory;

    // Si el nombre de la tabla no sigue la convención de pluralización de Laravel, especifica el nombre de la tabla
    protected $table = 'cacmq_registro_soporte';

    // Si no usas timestamps, descomenta la siguiente línea
    // public $timestamps = false;

    // Especifica los campos que son asignables en masa
    protected $fillable = [
        'reg_sop_usuario',
        'reg_sop_grupo',
        'reg_sop_tecnico',
        'reg_sop_fecha',
        'reg_sop_tipo_equipo',
        'reg_sop_detalle',
        'reg_sop_falla',
        'reg_sop_asistencia',
        'reg_sop_satisfaccion',
    ];
}