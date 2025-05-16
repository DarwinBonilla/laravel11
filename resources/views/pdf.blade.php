<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ $registro->reg_sop_fecha }}-{{ $registro->reg_sop_usuario }}-Formulario PDF</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
  <!-- Favicon -->
  <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">


  <!-- Styles -->
  <style>
    @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css");

    hr {
      border: 3px solid #666;
      border-radius: 300px/10px;
      height: 0px;
      text-align: center;
    }
    .bg-primary1 {
      /*background-color: #1D1F32;*/
      background-image: url("header1.jpg");
      background-size: contain;
      background-position: center;
      color: white;
    }
  
        /* Estilos para el PDF */
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            text-align: center;
            font-size: 16px;
            letter-spacing: 0.25em;
            word-spacing: 0.25em;
            font-family: Verdana;
        }
        h2 {
            text-align: center;
            font-size: 12px;
        }
        h3 {
            text-align: center;
            font-size: 11px;
        }
        h5{
          font-size: 07px;
          letter-spacing: 0.12em;
        }
        h6{
          font-size: 07px;
          letter-spacing: 0.10em;
          
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        .azul{
          background-color: #25A3E8;
          text-align: center;
          font-weight: bold;
        }
        .center{
          text-align: center;
        }
        .left{
          text-align: right;
        }
        /*MARGENES*/
        @page {
margin: 0.7cm 0.7cm;
}

footer {
position: fixed;
bottom: 0cm;
left: 0cm;
right: 0cm;
height: 3cm;
}

header{
  bottom: 0cm;
  position:static;
  height: 3cm;
  z-index: 1;
}
.logo{
  position: absolute;
  z-index: auto;
  left: 44%;
}

table{
  font-size: 08px;
}


.columna {
  min-width:70px;
  max-width: 50px;
  
  }
    
    </style>
</head>

<body>

<header class="masthead  text-white text-center">
<center><img src="{{ $imagePath1 }}" width=auto></center>
    </header>
    <div class="bg-primary1 container d-flex align-items-center flex-column">
        <!-- Titulo Formulario-->
         <br>
        <h1 class="center">REGISTRO DE SOPORTE TÉCNICO <br>~ Y MANTENIMIENTO ~</h1>
        
        <center><img class="logo"   src="{{ $imagePath }}" width="100px"></center>
        <br><br><br>
      </div>
      
   
@if($registro)
<br><br><br>
        <table>
            <tr>
            <td COLSPAN=4 class="azul">1. INFORMACIÓN DEL USUARIO</td>            
            </tr>

            <tr>
                <td ><strong>  Num. de Documento</strong></td>
                <td >CACMQ-TICS-2024-0{{ $registro->reg_sop_id }}-HAD</td>
                <td class="left"><strong>Fecha Inicio Soporte</strong></td>
                <td >{{ $registro->reg_sop_fecha }}</td>
            </tr>
            <tr>
                <td><strong>Usuario</strong></td>
                <td COLSPAN=3>{{ $registro->reg_sop_usuario }}</td>
            </tr>
            <tr>
                <td><strong>Grupo</strong></td>
                <td COLSPAN=3>{{ $registro->reg_sop_grupo }}</td>
            </tr>
            <tr>
            <td COLSPAN=4 class="azul">2. INFORMACIÓN GENERAL DEL SOPORTE</td>
            </tr>
            <tr>
                <td><strong>Técnico</strong></td>
                <td>{{ $registro->reg_sop_tecnico }}</td>
                <td class="left"><strong>Fecha Fin Soporte</strong></td>
                <td >{{ $registro->reg_sop_fecha }}</td>
            </tr>
            <tr>
                <td><strong>Tipo de Equipo</strong></td>
                <td COLSPAN=3>{{ $registro->reg_sop_tipo_equipo }}</td>
            </tr>
            
            <tr>
                <td><strong>Detalle</strong></td>
                <td COLSPAN=3>{{ $registro->reg_sop_detalle }}</td>
            </tr>
            <tr>
            <td COLSPAN=4 class="azul">3. DIAGNOSTICO Y SOLUCIONES</td>
            </tr>
            <tr>
                <td><strong>Falla Reportada</strong></td>
                <td COLSPAN=3>{{ $registro->reg_sop_falla }}</td>
            </tr>
            <tr>
            <td><strong>Asistencias</strong></td>
            <td COLSPAN=3>{{ is_array($registro->reg_sop_asistencia) ? implode(', ', json_decode($registro->reg_sop_asistencia, true)) : $registro->reg_sop_asistencia }}</td>

            </tr>
            <tr>
            <td COLSPAN=4 class="azul">4. SATISFACCIÓN</td>
            </tr>
            <tr>
                <td><strong>Satisfacción</strong></td>
                <td COLSPAN=3>{{ $registro->reg_sop_satisfaccion }}</td>
            </tr>
        </table>
    @else
        <p>No hay registros disponibles.</p>
    @endif

  <center><h5>***RECOMENDACIONES***<br><br>
  1. Mantén las contraseñas confidenciales, <b>NO COMPARTAS</b> tus credenciales con otros usuarios.<br>
  2. El uso del equipo es solo, para actividades laborales y responsabilidad del CUSTODIO DEL EQUIPO.<br>
  3. La información en el equipo es de exclusiva RESPONSABILIDAD del usuario.<br>
  4. NO ABRIR correos o archivos sospechosos, realizar RESPALDOS PERIÓDICOS de la información importante.<br>
  5. Antes de usar el equipo verificar el CAMBIO DE CUSTODIO, debidamente revisado por la unidad TICS.<br>
  6. Guarda toda la información antes de APAGAR EL EQUIPO, al finalizar la jornada laboral.
  </h5></center> 
  
    <TABLE BORDER class="columna">
	<TR>
		<TH COLSPAN=2><br><br><br><br></TH>
		<TH COLSPAN=2><br><br><br><br></TH>
	</TR>
	<TR>
  <TH COLSPAN=2 class="center columna"> {{$registro->reg_sop_tecnico }}</TH>
  <TH COLSPAN=2 class="center columna">{{ $registro->reg_sop_usuario }}</TH>
	</TR>
	<TR>
  <TH COLSPAN=2 class="azul">Técnico Unidad TICS</TH>
  <TH COLSPAN=2 class="azul">Usuario / Servidor</TH>
	</TR>
</TABLE>
<center><h6>Tecnologías de la Información y Comunicaciones CACMQ  -  Telf. 3730980 ext 1069  -  ticscacmq@quito.gob.ec  -  "HADES" version 1.0.1 2025</h6></center> 
       
  <footer >
    <center><img src="{{ $imagePath2 }}" width=auto></center>
</footer>
</body>




</html>