<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegistroSoporte; 
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Support\Facades\File;

class RegistroSoporteController extends Controller
{
    public function store(Request $request)
    {
                               

        // Guardar en la base de datos
        $registro = new RegistroSoporte();
        $registro->reg_sop_usuario = $request->reg_sop_usuario;
        $registro->reg_sop_grupo = $request->reg_sop_grupo;
        $registro->reg_sop_tecnico = $request->reg_sop_tecnico;
        $registro->reg_sop_fecha = $request->reg_sop_fecha;
        $registro->reg_sop_tipo_equipo = $request->reg_sop_tipo_equipo;
        $registro->reg_sop_detalle = $request->reg_sop_detalle;
        $registro->reg_sop_falla = $request->reg_sop_falla;
        $registro->reg_sop_asistencia = json_encode($request->reg_sop_asistencia); 
        $registro->reg_sop_satisfaccion = $request->reg_sop_satisfaccion;
           

        $registro->save();

        return to_route('welcome');

    }
    public function mostrarPDF()
    {
        $registro = DB::table('cacmq_registro_soporte')->orderBy('reg_sop_id', 'desc')->first();


        $imagePath = public_path('LOGOTICS.png');
        $imageData = base64_encode(File::get($imagePath));
        $base64Image = 'data:image/png;base64,' . $imageData;


        $imagePath1 = public_path('INT_ENC.png');
        $imageData1 = base64_encode(File::get($imagePath1));
        $base64Image1 = 'data:image/png;base64,' . $imageData1;

        $imagePath2 = public_path('INT_PIE.png');
        $imageData2 = base64_encode(File::get($imagePath2));
        $base64Image2 = 'data:image/png;base64,' . $imageData2;
        
        $datos = [
            
            'registro' => $registro,
            'imagePath' => $base64Image,
            'imagePath1' => $base64Image1,
            'imagePath2' => $base64Image2,
        ];
    
        $pdf = PDF::loadView('pdf', $datos);
        return $pdf->download($registro->reg_sop_fecha.'-'.$registro->reg_sop_usuario.'.pdf');
        // O para ver en el navegador:
         //return $pdf->stream($registro->reg_sop_fecha.'-'.$registro->reg_sop_usuario.'.pdf');
         
  }

  
    
    
    
}

        



