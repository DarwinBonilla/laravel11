<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CACMQ-TICS - Gráfico de Registros</title>
    @csrf

    <!-- Fuentes -->
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
<link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/png">
<link rel="apple-touch-icon" href="{{ asset('favicon.png') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Styles -->
    <style>
        @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css");

        body {
            background-image: url("{{ asset('FONDO.jpg') }}");
            background-size: auto;
            background-position: center;
            background-repeat: repeat-y;
            height: 100vh;
        }

        footer {
            background-color: #2A6E91;
            color: white;
            padding: 20px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .my-3 {
            -webkit-box-shadow: 1px 1px 20px 0px rgba(51, 131, 168, 1);
            box-shadow: 1px 1px 20px 0px rgba(51, 131, 168, 1);
        }

        .chart-container {
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 10px;
            padding: 20px;
            margin: 20px auto;
            max-width: 1200px;
        }

        .bg-primary1 {
            background-color: #3383A8;
        }

        .sombra {
            color: #FFFFFF;
            text-shadow: 1px 3px 0 #969696;
        }

        .chart-title {
            color: #2A6E91;
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
        }

        .btn-volver {
            background-color: #3383A8;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .btn-volver:hover {
            background-color: #2A6E91;
            color: white;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="masthead bg-primary1 text-white text-center py-4">
        <div class="container d-flex align-items-center flex-column">
            <img src="{{ asset('Hades_Logo.webp') }}" alt="" width="100px" class="sombra_img sombra">
            <img src="{{ asset('LOGOTICS.png') }}" alt="" width="90px" class="sombra_img">
            <h2 class="masthead-heading text-uppercase mb-0 sombra">ESTADÍSTICAS DE REGISTROS</h2>
            <p class="text-center">Tecnologías de la Información y Comunicaciones</p>
        </div>
    </header>
    <div class="container">
        <section class="row">
            <div class="col-md-12">
                <hr>
                <marquee><i>"No tengas miedo de fallar, ten miedo de no intentarlo".</i></marquee>
                <hr>
            </div>
            <br>
        </section>
    </div>
    <!-- Contenido Principal -->
     
    <div class="container mt-5 mb-5">
        <div class="chart-container my-3">
            <h3 class="chart-title">Registro de Incidencias Atendidas</h3>
            
            <!-- Filtros -->
            <div class="row mb-4">
    <div class="col-md-4">
        <form id="yearFilterForm" method="GET" action="{{ route('grafico.registros') }}">
            <select class="form-select" id="yearFilter" name="year" onchange="this.form.submit()">
                @foreach($años as $año)
                    <option value="{{ $año }}" {{ $año == $añoSeleccionado ? 'selected' : '' }}>
                        {{ $año }}
                    </option>
                @endforeach
            </select>
        </form>
        <div class="col-md-12">
    <select class="form-select" id="chartType">
        <option value="pie">Gráfico Circular</option>
        <option value="bar">Gráfico de Barras</option>
        <option value="line">Gráfico de Líneas</option>
        <option value="doughnut">Gráfico de Dona</option>
    </select>
</div>
    </div>

</div>

            <!-- Canvas para el gráfico -->
            <canvas id="registrosChart"></canvas>

            <!-- Tabla de resumen -->
            <div class="table-responsive mt-4">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Mes</th>
                            <th>Total Registros</th>
                            <th>Porcentaje</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total = array_sum($registros);
                        @endphp
                        @foreach($meses as $index => $mes)
                            <tr>
                                <td>{{ $mes }}</td>
                                <td>{{ $registros[$index] }}</td>
                                <td>
                                    {{ number_format(($registros[$index] / $total) * 100, 1) }}%
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="table-primary">
                            <td><strong>Total</strong></td>
                            <td><strong>{{ $total }}</strong></td>
                            <td><strong>100%</strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <!-- Script para el gráfico -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
    const colores = [
        'rgba(64, 159, 255, 0.8)',   
        'rgba(64, 255, 159, 0.8)',    
        '#FAEE07',    
        'rgba(75, 192, 192, 0.8)',    
        '#F91703',   
        '#5411FA',    
        'rgba(255, 99, 255, 0.8)',    
        '#FAB501',    
        '#FA138A',    
        '#07FA19',    
        '#02FAEF',    
        'rgba(159, 64, 255, 0.8)'    
    ];

    const bordeColores = colores.map(color => color.replace('0.8', '1'));

    const ctx = document.getElementById('registrosChart').getContext('2d');
    let chart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: JSON.parse('{!! json_encode($meses) !!}'),
            datasets: [{
            label: 'Registros por Mes',
            data: JSON.parse('{!! json_encode($registros) !!}'),
            backgroundColor: colores,
            borderColor: bordeColores,
            borderWidth: 1
                
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        color:'green',
                        stepSize: 1
                        
                    }
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Actividades Registradas por Mes - {{ $añoSeleccionado }}',
                    font: {
                        size: 16
                    }
                },
                
            }
        }
    });

    // Manejar el cambio de tipo de gráfico
    document.getElementById('chartType').addEventListener('change', function() {
        const newType = this.value;
        chart.destroy();
        chart = new Chart(ctx, {
            type: newType,
            data: {
                labels: JSON.parse('{!! json_encode($meses) !!}'),
                datasets: [{
                    label: 'Registros por Mes - {{ $añoSeleccionado }}',
                    data: JSON.parse('{!! json_encode($registros) !!}'),
                    backgroundColor: colores,
                    borderColor: bordeColores,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color:'green',
                            stepSize: 1
                        }
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Actividades Registradas por Mes - {{ $añoSeleccionado }}',
                        font: {
                            size: 16
                        }
                    }
                }
            }
        });
    });
});
    </script>
    
<div class="container mt-4 mb-5">
        <div class=" justify-content-center">
            <div class="col-md-4 text-center">
            <a href="{{ url('/Formulario-Soporte') }}" class="btn btn-primary btn-lg w-100">
                    <i class="bi bi-arrow-left"></i> Volver al Registro
                </a>
                
            </div>
        </div>
    </div>
    <!-- Footer -->
     <br>
    <hr><hr><hr><hr><hr>
    <hr><hr><hr><hr><hr>
    
    <footer class="text-center">
        
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <img src="{{ asset('favicon.png') }}" alt="" width="50px">
                    <p class="mb-0">
                        TICS - CACMQ <br>
                        Telf. 3730980 Ext. 1069
                    </p>
                    <hr class="my-2" style="border-color: white;">
                    <small>Copyright &copy; Tecnologías de la Información y Comunicaciones - CACMQ 2025</small><br>
                    <small>Desarrollado por Ing. Darwin O. Bonilla G.</small>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>