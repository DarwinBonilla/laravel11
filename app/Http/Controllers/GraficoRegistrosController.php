<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GraficoRegistrosController extends Controller
{
    public function index(Request $request)
    {
        // Obtener el año seleccionado o usar el año actual por defecto
        $añoSeleccionado = $request->input('year', date('Y'));

        // Obtener registros agrupados por mes para el año seleccionado
        $datos = DB::table('cacmq_registro_soporte')
            ->select(DB::raw('EXTRACT(MONTH FROM reg_sop_fecha::date) as mes'), DB::raw('COUNT(*) as total'))
            ->whereRaw('EXTRACT(YEAR FROM reg_sop_fecha::date) = ?', [$añoSeleccionado])
            ->groupBy('mes')
            ->orderBy('mes')
            ->get();

        // Preparar arrays para el gráfico
        $meses = [];
        $registros = [];

        // Nombres de los meses en español
        $nombresMeses = [
            1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
            5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
            9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
        ];

        foreach ($datos as $dato) {
            $meses[] = $nombresMeses[(int)$dato->mes];
            $registros[] = $dato->total;
        }

        // Generar array de años para el filtro
        $añoActual = date('Y');
        $años = range($añoActual - 2, $añoActual);

        return view('grafico_registros', compact('meses', 'registros', 'años', 'añoSeleccionado'));
    }
}