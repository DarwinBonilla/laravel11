<?php

namespace App\Http\Controllers;

use App\Models\CacmqUsuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use App\Models\CacmqGrupo;


class MyController extends Controller
{
    
    public function mostrarDatos()
{
    $usuarios = DB::table('cacmq_usuario')
    ->orderBy('usu_id', 'asc')
    ->get(); // Obtener datos de la tabla cacmq_usuario
    
    $grupos = DB::table('cacmq_grupo')->get(['grup_id', 'grup_nombre']); // Obtener datos de la tabla cacmq_grupo
    $equipos = DB::table('cacmq_equipo')->get();
    $tecnicos = DB::table('cacmq_tecnico')->get();
    return view('vista', compact('usuarios', 'grupos','equipos','tecnicos')); // Pasar conjunto de datos a la vista
}

}

