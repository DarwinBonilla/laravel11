<!DOCTYPE html>
<html lang="es">
<!--
**********************************************************************
*                                                                    *
*        SISTEMA DE REGISTRO DE SOPORTE TÉCNICO Y MANTENIMIENTO      *
*                       UNIDAD TICS DEL CACMQ                        *
*                                                                    *
*   Desarrollado por: Área de Desarrollo y Sistematización           *
*   Fecha de desarrollo: V1.0 16 de octubre 2024                     *
*                                                                    *
*   Descripción:                                                     *
*   Este sistema gestiona el registro y seguimiento de las           *
*   actividades de soporte técnico y mantenimiento para la           *
*   Unidad TICS del Cuerpo de Agentes de Control                     *
*   Metropolitano de Quito (CACMQ).                                  *
*                                                                    *
*   Funcionalidades principales:                                     *
*   1. Registro de incidentes y actividades de soporte técnico       *
*   2. Asignación de técnicos a las tareas de mantenimiento          *
*   3. Generación e impresión de informes en formato PDF             *
*   4. Registro automático de la ubicación del incidente             *
*   5. Automatización de la recopilación de datos del sistema        *
*   6. Conexión y sincronización con la base de datos central        *
*   7. Interfaz de usuario intuitiva para facilitar el uso           *
*   8. Histórico de mantenimientos y soportes realizados             *
*                                                                    *
*   Tecnologías utilizadas:                                          *
*   - Frontend: HTML5, CSS3, JavaScript                              *
*   - Backend: PHP / Laravel 11                                      *
*   - Base de datos: PosgreSQL                                       *
*   - Generación de PDF: mPDF                                      *
*   - Geolocalización: Google Maps                                   *
*                                                                    *
*   Nota: Este sistema es crucial para mantener la eficiencia        *
*   operativa de los servicios de soporte y mamntenimiento           *
*   del CACMQ.                                                       *
*                                                                    *
**********************************************************************
-->



<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>CACMQ-TICS</title>
  <title>@yield('title', 'Título por defecto')</title>

  <!-- Fuentes -->
  <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
  <!-- Favicon -->
  
  <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

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

    }

    .my-3 {
      -webkit-box-shadow: 1px 1px 20px 0px rgba(51, 131, 168, 1);
      
      box-shadow: 1px 1px 20px 0px rgba(51, 131, 168, 1);

    }

    hr {
      border: 3px solid #666;
      border-radius: 300px/10px;
      height: 0px;
      text-align: center;
    }

    .hr_footer {
      border: 3px solid white;
      border-radius: 100px/10px;
      height: 10px;
      width: auto;


    }

    .bg-primary1 {
      background-color: #3383A8;

    }
  </style>

</head>

</header>

<main class="mt-6">

  <body id="page-top">

    <header class="masthead bg-primary1 text-white text-center">
      <div class="container d-flex align-items-center flex-column">
        <!-- Sello Tics-->
        <img src="{{ asset('LOGOTICS.png') }}" alt="" width="150px">
        
        <!-- Titulo Formulario-->
        <h1 class="masthead-heading text-uppercase mb-0">REGISTRO DE SOPORTE TÉCNICO Y MANTENIMIENTO</h1>
        <p class="text-center">Tecnologías de la Información y Comunicaciones</p>

      </div>
    </header>
    
  
        <div class="card my-3">
          <div class="card-header text-center">
          <div class="col-md-12">
                <hr>
                <h3 class="text-center"><i>FORMULARIO ENVIADO.</i></h3>
                <h5 class="text-center"><i>"Gracias por su colaboración".</i></h5>
              </div>
          </div>

          <div class="clearfix"></div>
    <div>
      <div class="row justify-content-between m-3">
        

        <form action="{{ route('pdf.mostrar') }}" method="GET">
    <button type="submit" class="btn btn-primary">Ver PDF</button>
</form>
       
      </div>
    </div>
    </div>

        </div>

    

    <!--  NORMATIVA LEGAL-->
    <hr>
    <section class="row">
      <div class="col-md-12">
        <center>
          <h3>DECRETO EJECUTIVO 372 CERO PAPELES</h3>
        </center>
        <p></p>
      </div>
    </section>

    <section class="row">
      <div class="col-md-12 text-center">

        <h6>De acuerdo a la normativa de CERO PAPELES Se exhorta la utilización de las hojas de registro y se imprima lo mínimo necesario por la austeridad de impresión en el CACMQ.</h6>

      </div>
    </section><br />
    <hr>
    <section class="row">
      <div class="col-md-12">
        <center>
          <h3>ACUERDO MINISTERIAL No.017-2020.</h3>
        </center>
      </div>
    </section>

    <section class="row">
      <div class="col-md-12 text-center">

        <h6>Facilitar condiciones tecnológicas para que las entidades y organismos de la administración pública
          aumenten la calidad de conectividad para la atención delos servicios que presten a la ciudadanía, la
          generación, interconexión e integración de plataformas de información, la política digital cero papel, y
          la política de datos abiertos.</h6>


      </div>
    </section>
    </div>
    </div>
    </section>
  <!--  FIN NORMATIVA LEGAL-->

  </body>
</main>
<!-- FOOTER-->
<footer class="text-center">
  <div class="container">
    <div class="row">

      <div class="col-lg-12 mb-5 mb-lg-0">
        <br>
        <h4 class="text-uppercase mb-4 text-center">CONTÁCTENOS</h4>
        <img src="{{ asset('favicon.png') }}" alt="" width="100px">
        <p class="lead mb-0">
          Calle Juan bautista Aguirre
          <br>
          y Av. Simon Bolivar Sector (Las Mallas)
        </p>
      </div>

      <div class="col-lg-12 mb-5 mb-lg-0">
        <hr class="hr_footer">
        <h4 class="text-uppercase mb-4 text-center">LLÁMANOS</h4>
        <p class="lead mb-0">
          TICS - CACMQ <br>
          Telf. 3730980
          Ext. 1069
        </p>
      </div>
    </div>
  </div>

  <div class="container">
    <hr class="hr_footer"><small>Copyright &copy; Tecnologías de la Informacón y Comunicaciones - CACMQ 2024</small>
    <hr>
</footer>
<!-- FIN FOOTER-->

</html>