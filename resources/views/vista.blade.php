<!DOCTYPE html>
<html lang="es">
<!--
**********************************************************************
*                                                                    *
*        SISTEMA DE REGISTRO DE SOPORTE TÉCNICO Y MANTENIMIENTO      *
*                       UNIDAD TICS DEL CACMQ                        *
*                                                                    *
*   Desarrollado por: Área de Desarrollo y Sistematización           *
*   Fecha de desarrollo: V1.0 16 de Diciembre 2024                   *
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
*   - Frontend: HTML5, CSS3, JavaScript, Bootstrap                   *
*   - Backend: PHP / Laravel 11                                      *
*   - Base de datos: PosgreSQL                                       *
*   - Generación de PDF: DomPDF                                      *
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
  @csrf

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
    .hades{
      color: #ffffff;
      letter-spacing: .1em;
      text-shadow: 0 -1px 4px #FFF, 0 -2px 10px #ff0, 0 -10px 20px #ff8000, 0 -18px 40px #F000, -1px 0 #fff, 0 1px 0 #2e2e2e, 0 2px 0 #2c2c2c, 0 3px 0 #2a2a2a, 0 4px 0 #282828, 0 5px 0 #262626, 0 6px 0 #242424, 0 7px 0 #222, 0 8px 0 #202020, 0 9px 0 #1e1e1e, 0 5px 0 #1c1c1c, 0 5px 0 #1a1a1a, 0 2px 0 #181818, 0 1px 0 #161616, 0 1px 0 #141414, 0 1px 0 #121212;
    }
    .sombra{
      color: #FFFFFF;
      text-shadow: 1px 3px 0 #969696;
    }
    .sombra_img{
      filter: drop-shadow(5px 5px 10px #f9fafb);
    }
    .sombra_img:hover{
      filter: drop-shadow(5px 5px 10px #000000);
    }

  </style>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      $('.js-example-basic-single').select2();
    });
    
  </script>

</head>

<main class="mt-6">

  <body id="page-top">

    <header class="masthead bg-primary1 text-white text-center">
      <div class="container d-flex align-items-center flex-column">
        <!-- Sello Tics
        <h1 class="masthead-heading text-uppercase mb-0 hades" >-HADES-</h1>-->
        <img src="{{ asset('Hades_Logo.webp') }}" alt="" width="150px" class="sombra_img sombra">
        
        <img src="{{ asset('LOGOTICS.png') }}" alt="" width="120px" class="sombra_img">
        
        <!-- Titulo Formulario-->
        <h1 class="masthead-heading text-uppercase mb-0 sombra">REGISTRO DE SOPORTE TÉCNICO Y MANTENIMIENTO</h1>
        <p class="text-center">Tecnologías de la Información y Comunicaciones</p>
      </div>

    </header>
    <!-- SECCION GENERAL-->
    <section class="datos_generales" id="datos_generales">
      <div class="container">
        <div class="row justify-content-center">
          <br />
          <div class="container">
            <section class="row">
              <div class="col-md-12">
                <hr>
                <marquee><i>"No tengas miedo de fallar, ten miedo de no intentarlo".</i></marquee>
              </div>
              <br>
              <h6 class="text-danger">* Llenar todos los campos</h6>
            </section>
            <hr>

            <form action="{{ route('registro.soporte.store') }}" method="POST" id="FormRegistro">
              @csrf
              @method('POST')

              <!--  SECCION DATOS PERSONALES  -->
              <section class="row">
                <section class="col-md-12">
                  <div class="card my-3">
                    <div class="card-header">
                      <h3>Datos personales</h3>
                    </div>
                    <div class="card-body row justify-content-around">
                      <div class="col-sm-18">
                        <div class="form-group">
                          <div class="row justify-content-between m-3">

                            <select class="js-example-basic-single" name="reg_sop_usuario" required>
                              <option value="">Selecione..</option>
                              @foreach($usuarios as $usuario)
                                <option value="{{ $usuario->usu_apellidos }} {{ $usuario->usu_nombres }}"> {{ $usuario->usu_apellidos }} {{ $usuario->usu_nombres }} </option> <!-- Mostrar nombres y apellidos -->
                              @endforeach

                            </select>
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
              </section>
          <!-- FIN DATOS PERSONALES-->

          <!--  SECCION INFORMACION GENERAL -->
          <section class="row">
            <section class="col-md-12">
              <div class="card my-3">
                <div class="card-header">
                  <h3>Información General</h3>
                </div>

                <div class=" card-body row justify-content-around">
                  <div class="form-group">
                    <h6>Unidad o Grupo Operativo: <span class="text-danger"> *</span></h6>
                    <div class="row justify-content-between ">
                      <select class="js-example-basic-single" name="reg_sop_grupo" required>
                        <option value="">Seleccione..</option>

                        @foreach($grupos as $grupo)
                        <option value="{{ $grupo->grup_nombre }}">{{ $grupo->grup_nombre }}</option>
                        @endforeach

                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-12 card-body row justify-content-around">
                  <div class="form-group">
                    <h6>Ténico que atiende: <span class="text-danger"> *</span></h6>
                    <div class="row justify-content-between ">

                    <select class="js-example-basic-single" id="Nom_tecnico" name="reg_sop_tecnico" required>
                      <option value="ce">Selecione..</option>
                      @foreach($tecnicos as $tecnico)
                      <option value="{{ $tecnico->tec_nombre }}">{{ $tecnico->tec_nombre }}</option>
                      @endforeach

                    </select>
                    </div>
                  </div>
                </div>

                <div class="col-md-4 card-body row justify-content-around">
                  <div class="form-group">
                    <h6>Fecha Actual: <span class="text-danger"> *</span></h6>
                    <input type="date" class="form-control" name="reg_sop_fecha" value="{{ old('fechaActual', now()->format('Y-m-d')) }}" required>
                  </div>
                </div>

              </div>

            </section>
          </section>
          
          <!--  FIN SECCION INFORMACION GENERAL -->

          <!-- SECCION DATOS DEL EQUIPO  -->
          <section class="row">
            <section class="col-md-12">
              <div class="card my-3">
                <div class="card-header">
                  <h3>Datos del equipo</h3><br>
                </div>

                <section class="card-body row justify-content-around">
                  <div class="col-md-12">

                    <h6>Escoja el tipo de equipo: <span class="text-danger">*</span></h6>

                  </div>
                    <div class="col-md-2">
                    <label class="radio">
                      <input type="radio" name="reg_sop_tipo_equipo" id="preguntaa" value="Laptop" checked="checked"> LAPTOP
                    </label>

                  </div>
                  <div class="col-md-3">
                    <label class="radio">
                      <input type="radio" name="reg_sop_tipo_equipo" id="preguntab" value="Escritorio"> ESCRITORIO
                    </label>
                  </div>
                  <div class="col-md-3">
                    <label class="radio">
                      <input type="radio" name="reg_sop_tipo_equipo" id="preguntac" value="Impresora"> IMPRESORA
                    </label>
                  </div>

                  <div class="col-md-2">
                    <label class="radio">
                      <input type="radio" name="reg_sop_tipo_equipo" id="preguntad" value="Otros"> OTROS
                    </label>
                  </div>
                  <br>
                  <section class="row">
                    <div class="card-body row justify-content-around">
                      <br>
                      <h6>Código de Equipo: <span class="text-danger">*</span></h6>
                      <div class="row justify-content-between m-3">
                        <select class="js-example-basic-single" id="tipoAtencion" name="reg_sop_detalle" required>
                          <option value="ce">Seleccione..</option>
                          @foreach($equipos as $equipo)
                          <option value="{{ $equipo->equ_codigo }} {{ $equipo->equ_detalle }}">{{ $equipo->equ_codigo }} {{ $equipo->equ_detalle }} </option> <!-- Mostrar codigo y nombre -->
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </section>

                  <br>

                  <section class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <br>
                        <h6>Falla Reportada: <span class="text-danger">*</span></h6>

                        <textarea class="form-control" rows="6" id="comentarios"  name="reg_sop_falla" required></textarea>

                      </div>
                    </div>
                  </section>
                  <br>
              </div>
            </section>
          </section>
        </div>
        <!--  FIN DATOS DEL EQUIPO  -->

        <!--  SECCION ASISTENCIAS REALIZADAS -->

        <section class="row">
          <section class="col-md-12">

            <div class="card my-3">
              <div class="card-header">
                <h3>Asistencias Realizadas</h3>
              </div>

              <section class="row">
                <div class="col-md-12">
                  <h6>Escoja una o varias opciones:</h6>
                </div>
                <div>

                  <div class="card-body row justify-content-around">
                    <TABLE SOPORTE>
                      <TR>
                        <TD>
                          <div class="col-md-12">
                            <label class="check">
                              <input type="checkbox" name="reg_sop_asistencia[]" id="chdsk1" value="Cambio de contrasenias"> Cambio de contraseñas
                            </label>

                          </div>
                        </TD>
                        <TD>
                          <div class="col-md-8">
                            <label class="check">
                              <input type="checkbox" name="reg_sop_asistencia[]" id="chdsk2" value="Instalacion y Actualizacion de Programas"> Instalación y Actualización de Programas
                            </label>
                          </div>
                        </TD>
                      </TR>
                      <TR>
                        <TD>
                          <div class="col-md-8">
                            <label class="check">
                              <input type="checkbox" name="reg_sop_asistencia[]" id="chdsk3" value="Mantenimiento Correctivo"> Mantenimiento Correctivo
                            </label>
                          </div>
                        </TD>
                        <TD>
                          <div class="col-md-8">
                            <label class="check">
                              <input type="checkbox" name="reg_sop_asistencia[]" id="chdsk4" value="Mantenimiento Preventivo" checked="checked"> Mantenimiento Preventivo
                            </label>
                          </div>
                        </TD>
                      </TR>
                      <TR>
                        <TD>
                          <div class="col-md-8">
                            <label class="check">
                              <input type="checkbox" name="reg_sop_asistencia[]" id="chdsk5" value="Mantenimiento Impresora y Escaner"> Mantenimiento Impresora y Escaner
                            </label>
                          </div>
                        </TD>
                        <TD>
                          <div class="col-md-8">
                            <label class="check">
                              <input type="checkbox" name="reg_sop_asistencia[]" id="chdsk6" value="Configuracion Impresora y Escaner"> Configuración Impresora y Escaner

                            </label>
                          </div>
                        </TD>
                      </TR>
                      <TR>
                        <TD>
                          <div class="col-md-8">
                            <label class="check">
                              <input type="checkbox" name="reg_sop_asistencia[]" id="chdsk7" value="Creacion de Links"> Creación de Links
                            </label>
                          </div>
                        </TD>
                        <TD>
                          <div class="col-md-8">
                            <label class="check">
                              <input type="checkbox" name="reg_sop_asistencia[]" id="chdsk8" value="Cambios de Custodio"> Cambios de Custodio
                            </label>
                          </div>
                        </TD>
                      </TR>
                      <TR>
                        <TD>
                          <div class="col-md-4">
                            <label class="check">
                              <input type="checkbox" name="reg_sop_asistencia[]" id="chdsk9" value="Soporte Virtual"> Soporte Virtual
                            </label>
                          </div>
                        </TD>
                        <TD>
                          <div class="col-md-6">
                            <label class="check">
                              <input type="checkbox" name="reg_sop_asistencia[]" id="chdsk10" value="Configuracion de Usuario"> Configuración de Usuario
                            </label>
                          </div>
                        </TD>
                      </TR>
                      <TR>
                        <TD>
                          <div class="col-md-8">
                            <label class="check">
                              <input type="checkbox" name="reg_sop_asistencia[]" id="chdsk11" value="Soporte de Redes" > Soporte de Redes
                            </label>
                          </div>
                        </TD>
                        <TD>
                          <div class="col-md-8">
                            <label class="check">
                              <input type="checkbox" name="reg_sop_asistencia[]" id="chdsk12" value="Informes de Baja de Equipos"> Informes de Baja de Equipos
                            </label>
                          </div>
                        </TD>
                      </TR>
                      <TR>
                        <TD>
                          <div class="col-md-8">
                            <label class="check">
                              <input type="checkbox" name="reg_sop_asistencia[]" id="chdsk13" value="Formateo y Recuperación de USB"> Formateo y Recuperación de USB
                            </label>
                          </div>
                        </TD>
                        <TD>
                          <div class="col-md-8">
                            <label class="check">
                              <input type="checkbox" name="reg_sop_asistencia[]" id="chdsk14" value="Grabacion de CD - DVD"> Grabación de CD - DVD
                            </label>
                          </div>
                        </TD>
                      </TR>
                      <TR>
                        <TD>
                          <div class="col-md-8">
                            <label class="check">
                              <input type="checkbox" name="reg_sop_asistencia[]" id="chdsk15" value="Apoyo Reunion de Staff"> Apoyo Reunión de Staff
                            </label>
                          </div>
                        </TD>
                        <TD>
                          <div class="col-md-8">
                            <label class="check">
                              <input type="checkbox" name="reg_sop_asistencia[]" id="chdsk16" value="Soporte OneDrive"> Soporte OneDrive
                            </label>
                          </div>
                        </TD>
                      </TR>
                      <TR>
                        <TD>
                          <div class="col-md-8">
                            <label class="check">
                              <input type="checkbox" name="reg_sop_asistencia[]" id="chdsk17" value="Otras Configuraciones"> Otras Configuraciones
                            </label>
                          </div>
                        </TD>
                      </TR>
                    </TABLE>

                  </div>

                </div>

              </section>
          </section>
        </section>

        <!--  FIN ASISTENCIAS-->

        <!--  SECCION SATISFACCION-->

        <section class="row">
          <section class="col-md-12">
            <div class="card my-3">
              <div class="card-header">
                <h3>Satisfacción General</h3>
              </div>

              <div class="card-body row justify-content-around">
                <div class="col-md-12">
                  <p>¿Cómo calificaría su experiencia global respecto a los servicios que ha recibido en el área de TICs?</p>
                </div>
                <div class="row">
                  
                  
                  <TABLE SATISFACION>
                    <TR>
                      <TD><input checked="checked" id="exc" type="radio" name="reg_sop_satisfaccion" value="Excelente" />
                        <img src="{{ asset('5.png') }}" alt="" width="30px">
                      </TD>
                      <TD><input id="mbu" type="radio" name="reg_sop_satisfaccion" value="Muy bueno" />
                        <img src="{{ asset('4.png') }}" alt="" width="30px">
                      </TD>
                      <TD><input id="reg" type="radio" name="reg_sop_satisfaccion" value="Regular" />
                        <img src="{{ asset('3.png') }}" alt="" width="30px">
                      </TD>
                      <TD><input id="mal" type="radio" name="reg_sop_satisfaccion" value="Malo" />
                        <img src="{{ asset('2.png') }}" alt="" width="30px">
                      </TD>
                      <TD><input id="muy" type="radio" name="reg_sop_satisfaccion" value="Muy malo" />
                        <img src="{{ asset('1.png') }}" alt="" width="30px">
                      </TD>
                    </TR>
                    <TR>
                      <TD>Excelente</TD>
                      <TD>Muy <br>Buena</TD>
                      <TD>Regular</TD>
                      <TD>- Mala -</TD>
                      <TD>Muy Mala</TD>
                    </TR>
                  </TABLE>
                  
                </div>

              </div>

            </div>

          </section>

        </section>

        <!--  FIN SATISFACCION-->

        <div class="card my-3">
          <div class="card-header text-center">

            Gracias por su colaboración.
            Puede imprimir una copia al enviar su respuesta
          </div>

        </div>
    </section>

    <!--  BOTONES DE CONTROL FORMULARIO-->
    <div class="clearfix"></div>
    <div>
      <div class="row justify-content-between m-3">
        <input class="btn btn-primary pull-left col-sm-3" type="submit" value="Enviar Respuesta" name="btnEnvRes" id="btnEnviar">
       

        <a href="" class="btn btn-warning col-sm-3">Limpiar</a>
      </div>
    </div>
    </div>
    <br>
    </form>
    <!--  FIN BOTONES DE CONTROL FORMULARIO-->

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
    <hr class="hr_footer"><small>Copyright &copy; Tecnologías de la Informacón y Comunicaciones - CACMQ 2025</small><br>
    <small>Desarrollado por Ing. Darwin O. Bonilla G.</small>
    <hr>
</footer>
<!-- FIN FOOTER-->

</html>
