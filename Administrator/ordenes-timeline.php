<?php 
include("Lib/sesion.php");
include("Lib/display_error.php");
include("Lib/conexion.php");
include("Lib/formulas.php");
$IdUser=$_SESSION['IdUser'];
$IdRol=$_SESSION['IdRol'];
include("Lib/permisos.php");
 $MyIdTaller=$_SESSION['IdTaller'];
 $MiTaller=$_SESSION['nicktaller'];
date_default_timezone_set("America/Bogota");
$TiempoActual = date('Y-m-d H:i:s A');
$FechaActual = date('Y-m-d');
//print_r(session_get_cookie_params());
?>

<?php

$date = new DateTime();
$date->modify('-0 hours');
$date->modify('-45 minute');
$date->modify('-0 second');

$RestaMinutos=$date->format('Y-m-d H:i:s');

$DiaActual=date("d");
$MesActual=date("m");
$AnoActual=date("Y");


$HoraCero=($AnoActual."-".$MesActual."-".$DiaActual." 00:00:000");
$TiempoExacto = date('Y-m-d H:i:s');
//$CincoAntes=($AnoActual."-".$MesActual."-".$DiaActual." ".$RestaMinutos."");


$sql ="SELECT COUNT(Id_Temporal_Sol) as TotalOrdenes FROM t_temporal_sol WHERE Fecha_Solicitud >='".$RestaMinutos."' and Fecha_Solicitud <='".$TiempoExacto."'";
  //Echo($sql);
  $result = $conexion->query($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
  $TotalOrdenes=$row['TotalOrdenes'];                  
 }
}
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>Modasof</title>

    <meta name="description" content="Common form elements and layouts" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
     <!-- Notificaciones Push -->
    <script src="https://modasof.com/espejo/assets/js/push.min.js"></script>
    

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="https://modasof.com/espejo/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/font-awesome/4.5.0/css/font-awesome.min.css" />
     <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

    <!-- page specific plugin styles -->
    <link rel="stylesheet" href="https://modasof.com/espejo/assets/css/jquery-ui.custom.min.css" />
    <link rel="stylesheet" href="https://modasof.com/espejo/assets/css/chosen.min.css" />
    <link rel="stylesheet" href="https://modasof.com/espejo/assets/css/bootstrap-datepicker3.min.css" />
    <link rel="stylesheet" href="https://modasof.com/espejo/assets/css/bootstrap-timepicker.min.css" />
    <link rel="stylesheet" href="https://modasof.com/espejo/assets/css/daterangepicker.min.css" />
    <link rel="stylesheet" href="https://modasof.com/espejo/assets/css/bootstrap-datetimepicker.min.css" />
    <link rel="stylesheet" href="https://modasof.com/espejo/assets/css/bootstrap-colorpicker.min.css" />
    <link rel="stylesheet" href="https://modasof.com/espejo/assets/css/tinycircleslider.css" type="text/css" media="screen"/>

    <!-- text fonts -->
    <link rel="stylesheet" href="https://modasof.com/espejo/assets/css/fonts.googleapis.com.css" />
    <link rel="stylesheet" href="https://modasof.com/espejo/assets/css/AdminLTE.css">
    <link rel="stylesheet" href="./assets/css/_all-skins.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
 

    <!-- ace styles -->
    <link rel="stylesheet" href="https://modasof.com/espejo/assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

    <!--[if lte IE 9]>
      <link rel="stylesheet" href="https://modasof.com/espejo/assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
    <![endif]-->
    <link rel="stylesheet" href="https://modasof.com/espejo/assets/css/ace-skins.min.css" />
    <link rel="stylesheet" href="https://modasof.com/espejo/assets/css/ace-rtl.min.css" />

    <!--[if lte IE 9]>
      <link rel="stylesheet" href="https://modasof.com/espejo/assets/css/ace-ie.min.css" />
    <![endif]-->

    <!-- inline styles related to this page -->

    <!-- ace settings handler -->
    <script src="https://modasof.com/espejo/assets/js/ace-extra.min.js"></script>

    <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

    <!--[if lte IE 8]>
    <script src="https://modasof.com/espejo/assets/js/html5shiv.min.js"></script>
    <script src="https://modasof.com/espejo/assets/js/respond.min.js"></script>
    <![endif]-->
  <!--/Inicio Alertas-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <link href="https://modasof.com/espejo/assets/css/sweetalert.css" rel="stylesheet">
    <!-- Custom functions file -->
    <script src="https://modasof.com/espejo/assets/js/functions.js"></script>
    <!-- Sweet Alert Script -->
    <script src="https://modasof.com/espejo/assets/js/sweetalert.min.js"></script>
    <!--/Fin Alertas-->

    <link rel="stylesheet" href="https://modasof.com/espejo/assets/css/magnific-popup.css">
<script type="text/javascript">
  $(document).ready(function() {
  $('.image-link').magnificPopup({type:'image'});
});
</script>
<script type="text/javascript">
  setInterval("location.reload('index-produccion.php')",200000);
</script>
<script type="text/javascript">
  class InfiniteSlider {
  constructor(animTime = '10000', selector = '.slider', container = '#slider-container') {
    this.slider = document.querySelector(selector)
    this.container = document.querySelector(container)
    this.width = 0
    this.oldWidth = 0
    this.duration = parseInt(animTime)
    this.start = 0
    this.refresh = 0 //0, 1, or 2, as in steps of the animation
    this._prevStop = false
    this._stop = false
    this._oldTimestamp = 0
  }
  
  animate() {
    /* fix for browsers who like to run JS before images are loaded */
    const imgs = Array.prototype.slice.call(this.slider.querySelectorAll('img'))
            .filter(img => {
              return img.naturalWidth === 0
            })
    if (imgs.length > 0) {
      window.requestAnimationFrame(this.animate.bind(this));
      return
    }
    
    /* Add another copy of the slideshow to the end, keep track of original width */
    this.oldWidth = this.slider.offsetWidth
    const sliderText = '<span class="slider-extra">' + this.slider.innerHTML + '</span>'
    this.slider.innerHTML += sliderText

    /* can have content still when we move past original slider */
    this.width = this.slider.offsetWidth
    const minWidth = 2 * screen.width

    /* Add more slideshows if needed to keep a continuous stream of content */
    while (this.width < minWidth) {
      this.slider.innerHTML += sliderText
      this.width = this.slider.width
    }
    this.slider.querySelector('.slider-extra:last-child').classList.add('slider-last')
    
    /* loop animation endlesssly (this is pretty cool) */
    window.requestAnimationFrame(this.controlAnimation.bind(this))
  }
  
  halt() {
    this._stop = true
    this._prevStop = false
  }
  
  go() {
    this._stop = false
    this._prevStop = true
  }
  
  stagnate() {
    this.container.style.overflowX = "scroll"
  }
  
  controlAnimation(timestamp) {
    //console.log('this.stop: ' + this._stop + '\nthis.prevStop: ' + this._prevStop)
    if (this._stop === true) {
      if (this._prevStop === false) {
        this.slider.style.marginLeft = getComputedStyle(this.slider).marginLeft
        this._prevStop = true
        this._oldTimestamp = timestamp
      }
    } else if (this._stop === false && this._prevStop === true) {
      this._prevStop = false
      this.start = this.start + (timestamp - this._oldTimestamp)
    } else {
      //reset animation
      if (this.refresh >= 1) {
        this.start = timestamp
        this.slider.style.marginLeft = 0
        this.refresh = 0
        window.requestAnimationFrame(this.controlAnimation.bind(this))
        return
      }
      if (timestamp - this.start >= this.duration) {
        this.refresh = 1
      }
      
      const perc = ((timestamp - (this.start)) / this.duration) * this.oldWidth
      this.slider.style.marginLeft = (-perc) + 'px'
    }
    window.requestAnimationFrame(this.controlAnimation.bind(this))
    return
  }
  
  getIeWidth() {
    this.slider.style.marginLeft = '-99999px';
  }
  
  ie11Fix() {
    this.slider.querySelector('.slider-last').style.position = 'absolute';
  }
}

function detectIE() {
  var ua = window.navigator.userAgent
  var msie = ua.indexOf('MSIE ')

  if (msie > 0) {
    // IE 10 or older => return version number
    return parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10)
  }
  
  var trident = ua.indexOf('Trident/')
  if (trident > 0) {
    // IE 11 => return version number
    var rv = ua.indexOf('rv:')
    return parseInt(ua.substring(rv + 3, ua.indexOf('.', rv)), 10)
  }

  var edge = ua.indexOf('Edge/');
  if (edge > 0) {
    // Edge (IE 12+) => return version number
    return parseInt(ua.substring(edge + 5, ua.indexOf('.', edge)), 10)
  }

  // other browser
  return false
}


document.addEventListener('DOMContentLoaded', function() {
  const slider = new InfiniteSlider(430000)
  const ie = detectIE()
  
  //Dont animate under IE10, just place the images
  if (ie !== false && ie < 10) {
    slider.stagnate()
    return
  }
  //IE 11 and lower, fix for width *increasing* as more of the slider is shown
  if (ie !== false && ie < 12) { slider.getIeWidth() }
  
  slider.animate()
  document.querySelector('#slider-container')
    .addEventListener('mouseenter', slider.halt.bind(slider))
  document.querySelector('#slider-container')
    .addEventListener('mouseleave', slider.go.bind(slider))
  
  if (ie === 11) {
    setTimeout(slider.ie11Fix.bind(slider), 1000)
  }
});

</script>

    <?php include("Lib/Favicon.php") ?>

    <style type="text/css">
    #slider-container {
    height: 404px;
    width: 100vw;
    margin: 0 auto;
    position: relative;
    overflow: hidden;
  }
  .slider {
    position: absolute;
    display: flex;
    flex-flow: row nowrap;
  }
  .slider-instant {
    transition: none;
  }
  .slider-animate {
    margin-left: 0;
  }
  .slider-extra {
    display: flex;
    flex-flow: row nowrap;
  }
  .slider-last {
    min-width: 100vw;
    max-width: 100vw;
    overflow: hidden;
  }
  .slider span {
    margin-right: 30px;
  }
  .slider .slider-extra {
    margin-right: 0;
  }
  .slider img {
    height: inherit;
    vertical-align: inherit;
    border: inherit;
    width: auto;
    height: auto;
    max-width: 400px; 
      max-height: 400px;
  }
 


    </style>
   <!--  <style>
@keyframes rotate {from {transform: rotate(0deg);}
    to {transform: rotate(360deg);}}
@-webkit-keyframes rotate {from {-webkit-transform: rotate(0deg);}
  to {-webkit-transform: rotate(360deg);}}
.imgr{
    -webkit-animation: 2s rotate linear infinite;
    animation: 2s rotate linear infinite;
    -webkit-transform-origin: 50% 50%;
    transform-origin: 50% 50%;
}
/*#imgr2 {
     -webkit-animation-direction: reverse;
     animation-direction: reverse;
}*/
</style> -->
<!-- build:js jquery.tinycircleslider.js -->
  <!-- <script type="text/javascript">
  (function($){
    $.fn.downAndUp = function(time, repeat){
        var elem = this;
        (function dap(){
            elem.animate({scrollTop:elem.outerHeight()}, time, function(){
                elem.animate({scrollTop:0}, time, function(){
                    if(--repeat) dap();
                });
            });
        })();
    }
})(jQuery);
$("html").downAndUp(46000, 100)
  </script> -->
  </head>

  <body class="skin-1">

  <?php 
  $Valide=$_GET['Mensaje'];

    if ($Valide==2) {
        echo "<script>jQuery(function(){swal(\"¡Lo Sentimos!\", \"Datos Incorrectos\", \"error\");});</script>";
    };
    if ($Valide==1) {
        echo "<script>jQuery(function(){swal(\"¡ Orden de Estancia Guardada!\", \"Correctamente \", \"success\");});</script>";
    };
    if ($Valide==2) {
        echo "<script>jQuery(function(){swal(\"¡ Extra Cargada a Cliente!\", \"".$ClienteSel." \", \"success\");});</script>";
    };
   ?>

  <?php 
  include("Lib/Alertas.php")
   ?>

    <div class="main-container ace-save-state" id="main-container">
      <script type="text/javascript">
        try{ace.settings.loadState('main-container')}catch(e){}
      </script>

      <div id="sidebar" class="sidebar                  responsive                    ace-save-state">
        <script type="text/javascript">
          try{ace.settings.loadState('sidebar')}catch(e){}
        </script>

        <?php 
  include("Lib/links.php");
  //include("Lib/menuleft.php");
?>

        <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
          <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
        </div>
      </div>

      <div class="main-content">
        <div class="main-content-inner">
          <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
              
              <h2>Última Actualización: <?php Echo($TiempoActual); ?></h2>
              <?php 

  if ($TotalOrdenes>0) {
    ?>
  <audio style="display: none;" controls autoplay>
    <source src="audioalex.mp3" type="audio/ogg" >
    <source src="audioalex.mp3" type="audio/mpeg" >
    <source src="audioalex.mp3" type="audio/wav" >
</audio>
    <?php
  }
  else{
    ?>

    <audio style="display: none;" controls>
    <source src="audioalex.mp3" type="audio/ogg" preload="none">
    <source src="audioalex.mp3" type="audio/mpeg" preload="none">
    <source src="audioalex.mp3" type="audio/wav" preload="none">
</audio>
    <?php
  }
 ?>
             
            </ul><!-- /.breadcrumb -->

            
          </div>

          <div class="page-content">
        <?php 
          //include("Lib/colors.php");
        ?>
            <div class="row">

            


            
              <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->
                  <!-- <a href="#modal-form" role="button" class="blue" data-toggle="modal"> Form Inside a Modal Box </a> -->
                
          

            <!-- Inicio botones de acceso rápido -->
            <div class="col-sm-12 col-xs-12">
              
            <!--  <div class="col-sm-12">
              <a  href="panel-produccion.php">
              <div class="infobox" id="nuevoboton">
                      <div class="infobox-icon">
                        <i class="ace-icon fa fa-industry"></i>
                      </div>

                      <div class="infobox-data" >
                        <span class="infobox-data-number">Área Producción</span>
                        
                      </div>

                      
              </div>
              </a>
              <a  href="producto-crear.php">
              <div class="infobox " id="nuevoboton">
                      <div class="infobox-icon">
                        <i class="ace-icon fa fa-magic"></i>
                      </div>

                      <div class="infobox-data">
                        <span class="infobox-data-number">Diseño</span>
              </div>
              </div>
            </a>
              <a href="Compras.php">
              <div class="infobox" id="nuevoboton">
                      <div class="infobox-icon">
                        <i class="ace-icon fa fa-cart-arrow-down"></i>
                      </div>

                      <div class="infobox-data">
                        <span class="infobox-data-number"> Ventas</span>
                      </div>
              </div>
              </a>
            <a href="">
              <div class="infobox" id="nuevoboton">
                      <div class="infobox-icon">
                        <i class="ace-icon fa fa-industry"></i>
                      </div>

                      <div class="infobox-data">
                        <span class="infobox-data-number">4. PRODUCCIÓN</span>        
              </div>
                      
              </div>
            </a>
            <hr>
            

              </div> -->
   <!-- Generator: Jssor Slider Maker -->
    <!-- Source: https://www.jssor.com -->
    <script src="https://modasof.com/espejo/assets/js/jssor.slider-25.2.0.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        jssor_1_slider_init = function() {

            var jssor_1_options = {
              $AutoPlay: 1,
              $Idle: 0,
              $SlideDuration: 2500,
              $SlideEasing: $Jease$.$Linear,
              $PauseOnHover: 4,
              $SlideWidth: 300,
              $Cols: 4
            };

            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

            /*#region responsive code begin*/
            /*remove responsive code if you don't want the slider scales while window resizing*/
            function ScaleSlider() {
                var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
                if (refSize) {
                    refSize = Math.min(refSize, 1280);
                    jssor_1_slider.$ScaleWidth(refSize);
                }
                else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }
            ScaleSlider();
            $Jssor$.$AddEvent(window, "load", ScaleSlider);
            //$Jssor$.$AddEvent(window, "resize", ScaleSlider);
            $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
            /*#endregion responsive code end*/
        };
    </script>

            </div>
            <!-- Fin botones de acceso rápido -->
<!-- Small boxes (Stat box) -->
      <div  class="row">

        <?php 
        $sql ="SELECT COUNT(Id_Temporal_Sol) as TotalPendientes FROM t_temporal_sol WHERE Estado_Solicitud_Cliente='1'";
  //Echo($sql);
  $result = $conexion->query($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
  $TotalPendientes=$row['TotalPendientes'];                  
 }
}
$sql ="SELECT COUNT(Id_Temporal_Sol) as TotalInsumos FROM t_temporal_sol WHERE Estado_Solicitud_Cliente='2'";
  //Echo($sql);
  $result = $conexion->query($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
  $TotalInsumos=$row['TotalInsumos'];                  
 }
}
 $sql ="SELECT COUNT(Id_Temporal_Sol) as TotalInsumos1 FROM t_temporal_sol WHERE Estado_Solicitud_Cliente='3'";
  //Echo($sql);
  $result = $conexion->query($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
  $TotalInsumos1=$row['TotalInsumos1'];                  
 }
}
 $sql ="SELECT COUNT(Id_Temporal_Sol) as TotalInsumos2 FROM t_temporal_sol WHERE Estado_Solicitud_Cliente='4'";
  //Echo($sql);
  $result = $conexion->query($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
  $TotalInsumos2=$row['TotalInsumos2'];                  
 }
}

$SumaPendienteInsumos=$TotalInsumos+$TotalInsumos1+$TotalInsumos2;

$sql ="SELECT COUNT(Id_Temporal_Sol) as Sastre FROM t_temporal_sol WHERE Estado_Solicitud_Cliente='5'";
  //Echo($sql);
  $result = $conexion->query($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
  $Sastre=$row['Sastre'];                  
 }
}
$OrdenesPendientes=$TotalPendientes+$SumaPendienteInsumos+$Sastre;
         ?>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php Echo($TotalPendientes); ?> Prendas</h3>

              <p>Solicitados a Taller</p>
            </div>
            <div class="icon">
              <i class="fa fa-cogs"></i>
            </div>
            <a href="#" class="small-box-footer">
              Prendas sin gestión <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
       
         <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php Echo($SumaPendienteInsumos); ?> Prendas</h3>

              <p>Pendientes por Insumo</p>
            </div>
            <div class="icon">
              <i class="fa fa-cogs"></i>
            </div>
            <a href="#" class="small-box-footer">
              Prendas en gestión de insumos <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        
        <!-- ./col -->
       <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php Echo($Sastre); ?> Prendas</h3>

              <p>Sastre Asignado</p>
            </div>
            <div class="icon">
              <i class="fa fa-cogs"></i>
            </div>
            <a href="#" class="small-box-footer">
              Prendas en producción <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-black">
            <div class="inner">
           
              <h3><?php Echo($OrdenesPendientes);?> Prendas</h3>

              <p>Pendientes en Taller</p>
            </div>
            <div class="icon">
              <i class="fa fa-shopping-cart"></i>
            </div>
            <a href="#" class="small-box-footer">
              Prendas pendientes en taller <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
<?php
date_default_timezone_set("America/Bogota");
$MarcaTemporal = date('Y-m-d');
$nuevafecha = strtotime ( '-1 day' , strtotime ( $MarcaTemporal ) ) ;
$nuevafecha2 = strtotime ( '+2 day' , strtotime ( $MarcaTemporal ) ) ;
$nuevafecha = date ( 'Y-m-d' , $nuevafecha );
$nuevafecha2 = date ( 'Y-m-d' , $nuevafecha2 );
$FechaInicioDia=($nuevafecha." 00:00:000");
$FechaFinalDia=($nuevafecha2." 23:59:000");
$FechaUno=$_POST['start'];
$FechaDos=$_POST['end'];
// Validación de la fecha en que inicia el Día

if ($FechaUno=="") {
  $FechaStart=$FechaInicioDia;
          }
else
  {
    $FechaStart=($FechaUno." 00:00:000");
  }
// Validación de la fecha en que Termina el Día
if ($FechaDos=="") {
    $FechaEnd=$FechaFinalDia;
  }
else
  {
    $FechaEnd=($FechaDos." 23:59:000");
  }
?>
            <div class="col-sm-12 col-xs-12"><!-- Panel 2  -->
                 <div class="col-md-12">
              <!-- USERS LIST -->
            <div id="tabs-1" class="tab-pane fade in active"><!-- Inicio Tab Número Uno -->
                          <div style="display: none;" class="clearfix">
                      <div class="pull-left tableTools-container"></div>
                    </div>
                    <div class="table-header" style="background-color: #000;">
                      <h1>LISTA DE ORDENES PARA HOY <?php echo($FechaEnd) ?></h1>
                    </div>
                    
                    <!-- div.table-responsive -->

                    <!-- div.dataTables_borderWrap -->
                    <div>
                      <div id="slider-container">
  <div class="slider">



<?php 
// ************** Arreglo Total Insumos ***************//
if ($MyIdTaller=="") {
  $sql ="SELECT Id_Temporal_Sol FROM t_temporal_sol Where Estado_Solicitud_Cliente<'6' and Estado_Solicitud_Cliente>'0' and Fecha_Entrega >='".$FechaStart."' and Fecha_Entrega <='".$FechaEnd."' order by Id_Temporal_Sol  DESC";
  $result = $conexion->query($sql);
  //echo($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
  $Lista=$Lista.$row['Id_Temporal_Sol'].",";                  
 }
}
}
else
{
  $sql ="SELECT Id_Temporal_Sol FROM t_temporal_sol WHERE Bodega_Id_Bodega='".$MyIdTaller."' order by Id_Temporal_Sol  DESC";

  $result = $conexion->query($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
  $Lista=$Lista.$row['Id_Temporal_Sol'].",";                  
 }
}

}

$Cadena=explode(",", $Lista);
//Split al Arreglo
$longitud = count($Cadena);
$min=$longitud-1;
// ************** Arreglo Total Insumos ***************//
 ?>
                 
<?php 
for($i=0; $i<$min; $i++)
{
$sql ="SELECT Id_Temporal_Sol, Bodega_Id_Bodega, Cant_Solicitada, Talla_Solicitada, A.Tienda_Id_Tienda, Referencia_Id_Referencia, Fecha_Solicitud, Fecha_Observacion, Observa_Id_Usuario, Solicitud_Id_Usuari, Sastre_Id_Usuario, Vendedor_Id_Usuario, Valor_Prenda, Valor_Final, Valor_Adicional, Observa_Cliente, Dispon_Insumo, A.Cliente_Id_Cliente, Pedido_Id_Pedido, A.Fecha_Entrega, A.Fecha_EntregaCliente, Estado_Solicitud_Cliente, Valida_Estado_Sol, Estado_Depacho, Recibido_Despacho, Entregado_Despacho, Solicitud_Facturada, A.Factura_Num_Factura, B.Cod_Pedido, B.Id_Pedido,C.Nom_Cliente,C.Ape_Cliente, D.Nom_Tienda, E.Nombres, E.Apellidos,E.Img_perfil FROM t_temporal_sol as A, t_pedido as B, t_clientes as C, t_tiendas as D, t_usuarios as E Where A.Pedido_Id_Pedido=B.Cod_Pedido and A.Cliente_Id_Cliente=C.Id_Cliente and A.Tienda_Id_Tienda=D.Id_Tienda and A.Vendedor_Id_Usuario=E.Id_Usuario and Id_Temporal_Sol='".$Cadena[$i]."'"; 
//Echo($sql);
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $Fecha_Solicitud=$row['Fecha_Solicitud'];
        $Nombres=$row['Nombres'];
        $Apellidos=$row['Apellidos'];
        $AvatarVendedor=$row['Img_perfil'];
        $Nom_Cliente=$row['Nom_Cliente'];
         $Nom_Tienda=$row['Nom_Tienda'];
        $Ape_Cliente=$row['Ape_Cliente'];
        $Id_Pedido=$row['Id_Pedido'];
        $Cod_Pedido=$row['Cod_Pedido'];
        $Cliente_Id_Cliente=$row['Cliente_Id_Cliente'];
        $Estado_Solicitud_Cliente=$row['Estado_Solicitud_Cliente'];
        $Fecha_Entrega=$row['Fecha_Entrega'];
        $dateSol = new DateTime($Fecha_Solicitud);
        $HoraSol=$dateSol->format('H:i:s a');
        $FechaSol=$dateSol->format('Y-m-d');
  }
}
?>
 <?php 
    $sql ="SELECT A.Referencia_Id_Referencia,B.Img_Referencia,A.Estado_Solicitud_Cliente,C.Nom_Talla FROM t_temporal_sol as A, t_referencias as B,t_tallas as C WHERE Id_Temporal_Sol='".$Cadena[$i]."' and A.Referencia_Id_Referencia=B.Cod_Referencia and A.Talla_Solicitada=C.Id_Talla"; 
    //Echo($sql); 
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
    $Referencia_Id_Referencia=$row['Referencia_Id_Referencia'];
    $Img_Referencia=$row['Img_Referencia'];
     $Estado_Solicitud_Cliente=$row['Estado_Solicitud_Cliente'];
     $Nom_Talla=$row['Nom_Talla'];
     $Ref_Completa=$Referencia_Id_Referencia."-".$Nom_Talla;
    
      }
    }
            ?>
            <span><h1><?php echo($Nom_Cliente." ".$Ape_Cliente); ?><br>
               <?php 
    $sql ="SELECT `Id_Estado_Pedido`,Nom_Estado_Pedido, `Color_Estado`, `Desc_Estado`, `Rol_Id_Rol` FROM `t_estado_pedidos` WHERE Id_Estado_Pedido='".$Estado_Solicitud_Cliente."'"; 
    //Echo($sql); 
$result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { 
    $Id_Estado_Pedido=$row['Id_Estado_Pedido'];
    $Nom_Estado_Pedido=$row['Nom_Estado_Pedido'];
    $Color_Estado=$row['Color_Estado'];
      Echo("<span class='label' style='background-color:".$Color_Estado."'>".utf8_encode($Nom_Estado_Pedido)."</span> <span class='action-icons'></span>");
      }
    }
            ?>
            </h1></span>
  <img src="<?php echo utf8_encode($Img_Referencia); ?>" width="45px" height="45px" >
  <br>
  <h1><?php echo(fechasql($Fecha_Entrega)); ?></h1>
  
  
          

                          <?php 
                          
}
                           ?>
                            </div>
</div>
                        
                    </div>

                          
                        </div><!-- Fin Tab Número Uno -->
              <!--/.box -->
            </div>
              
              <div style="display: none;" class="col-sm-3">
                    <div class="widget-box">
                      <div class="widget-header">
                        <h4 class="widget-title lighter smaller">
                          <i class="ace-icon fa fa-comment blue"></i>
                          Actualizaciones Recientes
                        </h4>
                      </div>

                      <div class="widget-body">
                        <div class="widget-main no-padding">
                          <div class="dialogs">
                            <?php 
                            $sql="SELECT date_format(Fecha_Actualiza,CONCAT(CONCAT(ELT(WEEKDAY(Fecha_Actualiza) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo')),', %d - ',CONCAT(ELT(MONTH(Fecha_Actualiza), 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Agos', 'Sep', 'Oct', 'Nov', 'Dic')),'- %Y')) AS FechaActualiza,Id_Actualizacion_Orden, Actualiza_Id_Usuario, Fecha_Actualiza, Comentario_Actualiza, SolTem_Id_Solicitud, Pedido_Id_Pedido, Estado_Actualiza,Nombres, Apellidos, Img_perfil FROM t_actualizacion_ordenes as A, t_usuarios as B WHERE A.Actualiza_Id_Usuario=B.Id_Usuario order by Id_Actualizacion_Orden DESC";
                            //Echo($sql);
                              $result = $conexion->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {                
        $FechaActualiza=$row['FechaActualiza'];
        $Id_Actualizacion_Orden=$row['Id_Actualizacion_Orden'];
        $Actualiza_Id_Usuario=$row['Actualiza_Id_Usuario'];
        $Fecha_Actualiza=$row['Fecha_Actualiza'];
        $Comentario_Actualiza=$row['Comentario_Actualiza'];
        $SolTem_Id_Solicitud=$row['SolTem_Id_Solicitud'];
        $Pedido_Id_Pedido=$row['Pedido_Id_Pedido'];
        $Estado_Actualiza=$row['Estado_Actualiza'];
        $Nombres=$row['Nombres'];
        $Apellidos=$row['Apellidos'];
        $AvatarVendedor=$row['Img_perfil'];
       
        $dateSol = new DateTime($Fecha_Actualiza);
        $HoraSol=$dateSol->format('H:i:s a');
        $FechaSol=$dateSol->format('Y-m-d');


                             ?>
                            <div class="itemdiv dialogdiv">
                              <div class="user">
                                <img alt="Alexa's Avatar" src="<?php Echo($AvatarVendedor) ?>" />
                              </div>

                              <div class="body">
                                <div class="time">
                                  <i class="ace-icon fa fa-clock-o"></i>
                                  <span class="green"><?php Echo($HoraSol); ?></span>
                                </div>

                                <div class="name">
                                  <a href="#"><?php Echo($Nombres." ".$Apellidos);?></a>
                                </div>
                                <div class="text"><?php Echo($Comentario_Actualiza); ?>
                                  <br><strong>Pedido Nº:</strong><a href=""></a> PDC<?php Echo($Pedido_Id_Pedido) ?>
                                  <br><strong>Solicitud Nº:</strong>SCL<?php Echo($SolTem_Id_Solicitud) ?>
                                </div>

                                <div class="tools">
                                  <a href="#" class="btn btn-minier btn-info">
                                    <i class="icon-only ace-icon fa fa-share"></i>
                                  </a>
                                </div>
                              </div>
                            </div>
<?php 
      }
    }
    else
    {
 ?>
 <h5>No hay actualizaciones recientes</h5>
 <?php 
}
  ?>  
                           
                          </div>

                        <!--   <form>
                            <div class="form-actions">
                              <div class="input-group">
                                <input placeholder="Type your message here ..." type="text" class="form-control" name="message" />
                                <span class="input-group-btn">
                                  <button class="btn btn-sm btn-info no-radius" type="button">
                                    <i class="ace-icon fa fa-share"></i>
                                    Send
                                  </button>
                                </span>
                              </div>
                            </div>
                          </form> -->
                        </div><!-- /.widget-main -->
                      </div><!-- /.widget-body -->
                    </div><!-- /.widget-box -->
                  </div><!-- /.col -->
            </div> <!-- Fin Panel 2 -->
            
              </div><!-- /.col -->
            </div><!-- /.row -->
          </div><!-- /.page-content -->
        </div>
      </div><!-- /.main-content -->

      <?php 
  include("Lib/footer.php")
   ?>

      <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
        <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
      </a>
    </div><!-- /.main-container -->

    <!-- basic scripts -->

    <!--[if !IE]> -->
    <script src="https://modasof.com/espejo/assets/js/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="https://modasof.com/espejo/assets/js/jquery.tinycircleslider.js"></script>
    <!-- /build -->
  <script type="text/javascript">
    $(document).ready(function()
    {
      $('#rotatescroll').tinycircleslider({ interval: true, dotsSnap: true, dotsHide: true });
    });
  </script>

    <!-- <![endif]-->

    <!--[if IE]>
<script src="https://modasof.com/espejo/assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
    <script type="text/javascript">
      if('ontouchstart' in document.documentElement) document.write("<script src='https://modasof.com/espejo/assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
    </script>
    <script src="https://modasof.com/espejo/assets/js/bootstrap.min.js"></script>

    <!-- page specific plugin scripts -->

    <!--[if lte IE 8]>
      <script src="https://modasof.com/espejo/assets/js/excanvas.min.js"></script>
    <![endif]-->
    <script src="https://modasof.com/espejo/assets/js/jquery-ui.custom.min.js"></script>
    <script src="https://modasof.com/espejo/assets/js/jquery.ui.touch-punch.min.js"></script>
    <script src="https://modasof.com/espejo/assets/js/chosen.jquery.min.js"></script>
    <script src="https://modasof.com/espejo/assets/js/spinbox.min.js"></script>
    <script src="https://modasof.com/espejo/assets/js/bootstrap-datepicker.min.js"></script>
    <script src="https://modasof.com/espejo/assets/js/bootstrap-timepicker.min.js"></script>
    <script src="https://modasof.com/espejo/assets/js/moment.min.js"></script>
    <script src="https://modasof.com/espejo/assets/js/daterangepicker.min.js"></script>
    <script src="https://modasof.com/espejo/assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="https://modasof.com/espejo/assets/js/bootstrap-colorpicker.min.js"></script>
    <script src="https://modasof.com/espejo/assets/js/jquery.knob.min.js"></script>
    <script src="https://modasof.com/espejo/assets/js/autosize.min.js"></script>
    <script src="https://modasof.com/espejo/assets/js/jquery.inputlimiter.min.js"></script>
    <script src="https://modasof.com/espejo/assets/js/jquery.maskedinput.min.js"></script>
    <script src="https://modasof.com/espejo/assets/js/bootstrap-tag.min.js"></script>

    <!-- ace scripts -->
    <script src="https://modasof.com/espejo/assets/js/ace-elements.min.js"></script>
    <script src="https://modasof.com/espejo/assets/js/ace.min.js"></script>


    <!-- Inicio scripts Tablas -->
    <!-- page specific plugin scripts -->
    <script src="https://modasof.com/espejo/assets/js/jquery.dataTables.min.js"></script>
    <script src="https://modasof.com/espejo/assets/js/jquery.dataTables.bootstrap.min.js"></script>
    <script src="https://modasof.com/espejo/assets/js/dataTables.buttons.min.js"></script>
    <script src="https://modasof.com/espejo/assets/js/buttons.flash.min.js"></script>
    <script src="https://modasof.com/espejo/assets/js/buttons.html5.min.js"></script>
    <script src="https://modasof.com/espejo/assets/js/buttons.print.min.js"></script>
    <script src="https://modasof.com/espejo/assets/js/buttons.colVis.min.js"></script>
    <script src="https://modasof.com/espejo/assets/js/dataTables.select.min.js"></script>
    
    <script src="https://modasof.com/espejo/assets/js/pdfmake.min.js"></script>
    <script src="https://modasof.com/espejo/assets/js/vfs_fonts.js"></script>
    <script src="https://modasof.com/espejo/assets/js/jszip.min.js"></script>
    
    
    <script src="https://modasof.com/espejo/assets/js/jquery.validate.min.js"></script>
    <script src="https://modasof.com/espejo/assets/js/jquery-additional-methods.min.js"></script>

    <script src="https://modasof.com/espejo/assets/js/jquery.magnific-popup.js"></script>
    <script src="https://modasof.com/espejo/assets/js/jquery.magnific-popup.min.js"></script>
    
    <!-- inline scripts related to this page -->

    
  <script type="text/javascript">
        $(document).ready(function()
        {
             $("#validation-form").validate({
              errorElement: 'div',
          errorClass: 'help-block',
          focusInvalid: true,
          ignore: "",
                 rules: {
                     "TxtTitulo": { required:true },
                     "TxtHoras": { required:true }, 
                     "TxtTiempoDia": { required:true }, 
                     "TxtTiempoHora": { required:true },
                     "TxtTiempoMinuto": { required:true }, 
                     "TxtDetalle": { required:true }, 
                     "TxtUsuario": { required:true }, 

                 },
                 messages: {
                     "txtNombre": { required:"Debes incluir al menos un Usuario",},
                    
                 },

                 // submitHandler: function(form){
                 //     alert("Los datos son correctos");
                 // }

             });
        });
    </script>

<script type="text/javascript">
        $(document).ready(function()
        {
             $("#FormExtra").validate({
              errorElement: 'div',
          errorClass: 'help-block',
          focusInvalid: true,
          ignore: "",
                 rules: {
                     "TxtTipoExtra": { required:true },
                     "TxtHabitacion": { required:true }, 
                     
                    

                 },
                 messages: {
                     "txtNombre": { required:"Debes incluir al menos un Usuario",},
                    
                 },

                 // submitHandler: function(form){
                 //     alert("Los datos son correctos");
                 // }

             });
        });
    </script>

    
    <script type="text/javascript">
      jQuery(function($) {
        //initiate dataTables plugin

        // Setup - add a text input to each header cell
    
// Inicio Script para Filtros con Selects
  //   $('#dynamic-table').DataTable( {

    //     initComplete: function () {
    //         this.api().columns([1,2,3]).every( function () {
    //             var column = this;
    //             var select = $('<select><option value="">Filtrar...</option></select>')
    //                 .appendTo( $(column.header()).empty() )
    //                 .on( 'change', function () {
    //                     var val = $.fn.dataTable.util.escapeRegex(
    //                         $(this).val()
    //                     );
    //                     column
    //                         .search( val ? '^'+val+'$' : '', true, false )
    //                         .draw();
    //                 } );
    //                 orderCellsTop: true,
 
    //             column.data().unique().sort().each( function ( d, j ) {
    //                 select.append( '<option value="'+d+'">'+d+'</option>' )
    //             } );
    //         } );
    //     }

// Fin Script  para Filtros con Selects

    // } );
$('#dynamic-table thead tr:eq(1) th').each( function () {
        var title = $('#dynamic-table thead tr:eq(0) th').eq( $(this).index() ).text();
        $(this).html( '<input style="width:100%;border:black solid 1px;" type="text" placeholder="Buscar '+title+'" />' );
    } ); 
  
    var table = $('#dynamic-table').DataTable({

      "order": [[ 1, "Desc" ]],
        orderCellsTop: true,
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "No se ha encontrado nada - Lo sentimos",
            "info": "Mostrar página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
           },
      
    "lengthMenu": [[500, 700, 1000, -1], [500, 700, 1000, "All"]],

          select: {
            style: 'multi'
          },

    });
  
    // Apply the search
    table.columns().every(function (index) {
        $('#dynamic-table thead tr:eq(1) th:eq(' + index + ') input').on('keyup change', function () {
            table.column($(this).parent().index() + ':visible')
                .search(this.value)
                .draw();    
        });
    });

        var myTable = 
        $('#dynamic-table')
        //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
        .DataTable( {
retrieve: true,

          
          "aoColumns": [
            { "bSortable": false },
            null, null,null, null,null,null,null,
            { "bSortable": false }
          ],
          "aaSorting": [],
          "scrollX": true,
          
          //"bProcessing": true,
              //"bServerSide": true,
              //"sAjaxSource": "http://127.0.0.1/table.php" ,
      
          //,
          
          //"sScrollXInner": "120%",
          //"bScrollCollapse": true,
          //Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
          //you may want to wrap the table inside a "div.dataTables_borderWrap" element
      
          //"iDisplayLength": 50

      
          } );
      
        
    

        
        $.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';
        
        new $.fn.dataTable.Buttons( myTable, {
          buttons: [
            {
            "extend": "colvis",
            "text": "<i class='fa fa-search bigger-110 blue'></i> <span class='hidden'>Ver/Ocultar columnas</span>",
            "className": "btn btn-white btn-primary btn-bold",
            columns: ':gt(0)'
            },
            {
            "extend": "copy",
            "text": "<i class='fa fa-copy bigger-110 pink'></i> <span class='hidden'>Copiar Tabla</span>",
            "className": "btn btn-white btn-primary btn-bold"
            },
            {
            "extend": "csv",
            "text": "<i class='fa fa-database bigger-110 orange'></i> <span class='hidden'>Exportar a CSV</span>",
            "className": "btn btn-white btn-primary btn-bold"
            },
            {

            "extend": "excelHtml5",
            "text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Exportar a Excel</span>",
            "className": "btn btn-white btn-primary btn-bold"

            },
            {

            "extend": "pdf",
            "text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
            "className": "btn btn-white btn-primary btn-bold"
            },
            {
            "extend": "print",
            "text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Imprimir</span>",
            "className": "btn btn-white btn-primary btn-bold",
            autoPrint: true,
            message: 'Está impresión se produjo desde la App'
            }     
          ]
        } );
        myTable.buttons().container().appendTo( $('.tableTools-container') );
        
        //style the message box
        var defaultCopyAction = myTable.button(1).action();
        myTable.button(1).action(function (e, dt, button, config) {
          defaultCopyAction(e, dt, button, config);
          $('.dt-button-info').addClass('gritter-item-wrapper gritter-info gritter-center white');
        });
        


        
        var defaultColvisAction = myTable.button(0).action();
        myTable.button(0).action(function (e, dt, button, config) {
          
          defaultColvisAction(e, dt, button, config);
          
          
          if($('.dt-button-collection > .dropdown-menu').length == 0) {
            $('.dt-button-collection')
            .wrapInner('<ul class="dropdown-menu dropdown-light dropdown-caret dropdown-caret" />')
            .find('a').attr('href', '#').wrap("<li />")
          }
          $('.dt-button-collection').appendTo('.tableTools-container .dt-buttons')
        });
      
        ////
      
        setTimeout(function() {
          $($('.tableTools-container')).find('a.dt-button').each(function() {
            var div = $(this).find(' > div').first();
            if(div.length == 1) div.tooltip({container: 'body', title: div.parent().text()});
            else $(this).tooltip({container: 'body', title: $(this).text()});
          });
        }, 500);
        
        
        
        
        
        myTable.on( 'select', function ( e, dt, type, index ) {
          if ( type === 'row' ) {
            $( myTable.row( index ).node() ).find('input:checkbox').prop('checked', true);
          }
        } );
        myTable.on( 'deselect', function ( e, dt, type, index ) {
          if ( type === 'row' ) {
            $( myTable.row( index ).node() ).find('input:checkbox').prop('checked', false);
          }
        } );
      
      
      
      
      
      
        /////////////////////////////////
        //table checkboxes
        $('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);
        
        //select/deselect all rows according to table header checkbox
        $('#dynamic-table > thead > tr > th input[type=checkbox], #dynamic-table_wrapper input[type=checkbox]').eq(0).on('click', function(){
          var th_checked = this.checked;//checkbox inside "TH" table header
          
          $('#dynamic-table').find('tbody > tr').each(function(){
            var row = this;
            if(th_checked) myTable.row(row).select();
            else  myTable.row(row).deselect();
          });
        });
        
        //select/deselect a row when the checkbox is checked/unchecked
        $('#dynamic-table').on('click', 'td input[type=checkbox]' , function(){
          var row = $(this).closest('tr').get(0);
          if(this.checked) myTable.row(row).deselect();
          else myTable.row(row).select();
        });
      
      
      
        $(document).on('click', '#dynamic-table .dropdown-toggle', function(e) {
          e.stopImmediatePropagation();
          e.stopPropagation();
          e.preventDefault();
        });
        
        
        
        //And for the first simple table, which doesn't have TableTools or dataTables
        //select/deselect all rows according to table header checkbox
        var active_class = 'active';
        $('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
          var th_checked = this.checked;//checkbox inside "TH" table header
          
          $(this).closest('table').find('tbody > tr').each(function(){
            var row = this;
            if(th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
            else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
          });
        });
        
        //select/deselect a row when the checkbox is checked/unchecked
        $('#simple-table').on('click', 'td input[type=checkbox]' , function(){
          var $row = $(this).closest('tr');
          if($row.is('.detail-row ')) return;
          if(this.checked) $row.addClass(active_class);
          else $row.removeClass(active_class);
        });
      
        
      
        /********************************/
        //add tooltip for small view action buttons in dropdown menu
        $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
        
        //tooltip placement on right or left
        function tooltip_placement(context, source) {
          var $source = $(source);
          var $parent = $source.closest('table')
          var off1 = $parent.offset();
          var w1 = $parent.width();
      
          var off2 = $source.offset();
          //var w2 = $source.width();
      
          if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
          return 'left';
        }
        
        
        
        
        /***************/
        $('.show-details-btn').on('click', function(e) {
          e.preventDefault();
          $(this).closest('tr').next().toggleClass('open');
          $(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
        });
        /***************/
        
        
        
        
        
        /**
        //add horizontal scrollbars to a simple table
        $('#simple-table').css({'width':'2000px', 'max-width': 'none'}).wrap('<div style="width: 1000px;" />').parent().ace_scroll(
          {
          horizontal: true,
          styleClass: 'scroll-top scroll-dark scroll-visible',//show the scrollbars on top(default is bottom)
          size: 2000,
          mouseWheelLock: true
          }
        ).css('padding-top', '12px');
        */
      
      
      })
    </script>
    <!-- Final Scripts Tablas -->

    <!-- inline scripts related to this page -->
    <script type="text/javascript">
      jQuery(function($) {
        $('#id-disable-check').on('click', function() {
          var inp = $('#form-input-readonly').get(0);
          if(inp.hasAttribute('disabled')) {
            inp.setAttribute('readonly' , 'true');
            inp.removeAttribute('disabled');
            inp.value="This text field is readonly!";
          }
          else {
            inp.setAttribute('disabled' , 'disabled');
            inp.removeAttribute('readonly');
            inp.value="This text field is disabled!";
          }
        });
      
      
        if(!ace.vars['touch']) {
          $('.chosen-select').chosen({allow_single_deselect:true}); 
          //resize the chosen on window resize
      
          $(window)
          .off('resize.chosen')
          .on('resize.chosen', function() {
            $('.chosen-select').each(function() {
               var $this = $(this);
               $this.next().css({'width': $this.parent().width()});
            })
          }).trigger('resize.chosen');
          //resize chosen on sidebar collapse/expand
          $(document).on('settings.ace.chosen', function(e, event_name, event_val) {
            if(event_name != 'sidebar_collapsed') return;
            $('.chosen-select').each(function() {
               var $this = $(this);
               $this.next().css({'width': $this.parent().width()});
            })
          });
      
      
          $('#chosen-multiple-style .btn').on('click', function(e){
            var target = $(this).find('input[type=radio]');
            var which = parseInt(target.val());
            if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
             else $('#form-field-select-4').removeClass('tag-input-style');
          });
        }
      
      
        $('[data-rel=tooltip]').tooltip({container:'body'});
        $('[data-rel=popover]').popover({container:'body'});
      
        autosize($('textarea[class*=autosize]'));
        
        $('textarea.limited').inputlimiter({
          remText: '%n character%s remaining...',
          limitText: 'max allowed : %n.'
        });
      
        $.mask.definitions['~']='[+-]';
        $('.input-mask-date').mask('99/99/9999');
        $('.input-mask-phone').mask('(999) 999-9999');
        $('.input-mask-eyescript').mask('~9.99 ~9.99 999');
        $(".input-mask-product").mask("a*-999-a999",{placeholder:" ",completed:function(){alert("You typed the following: "+this.val());}});
      
      
      
        $( "#input-size-slider" ).css('width','200px').slider({
          value:1,
          range: "min",
          min: 1,
          max: 8,
          step: 1,
          slide: function( event, ui ) {
            var sizing = ['', 'input-sm', 'input-lg', 'input-mini', 'input-small', 'input-medium', 'input-large', 'input-xlarge', 'input-xxlarge'];
            var val = parseInt(ui.value);
            $('#form-field-4').attr('class', sizing[val]).attr('placeholder', '.'+sizing[val]);
          }
        });
      
        $( "#input-span-slider" ).slider({
          value:1,
          range: "min",
          min: 1,
          max: 12,
          step: 1,
          slide: function( event, ui ) {
            var val = parseInt(ui.value);
            $('#form-field-5').attr('class', 'col-xs-'+val).val('.col-xs-'+val);
          }
        });
      
      
        
        //"jQuery UI Slider"
        //range slider tooltip example
        $( "#slider-range" ).css('height','200px').slider({
          orientation: "vertical",
          range: true,
          min: 0,
          max: 100,
          values: [ 17, 67 ],
          slide: function( event, ui ) {
            var val = ui.values[$(ui.handle).index()-1] + "";
      
            if( !ui.handle.firstChild ) {
              $("<div class='tooltip right in' style='display:none;left:16px;top:-6px;'><div class='tooltip-arrow'></div><div class='tooltip-inner'></div></div>")
              .prependTo(ui.handle);
            }
            $(ui.handle.firstChild).show().children().eq(1).text(val);
          }
        }).find('span.ui-slider-handle').on('blur', function(){
          $(this.firstChild).hide();
        });
        
        
        $( "#slider-range-max" ).slider({
          range: "max",
          min: 1,
          max: 10,
          value: 2
        });
        
        $( "#slider-eq > span" ).css({width:'90%', 'float':'left', margin:'15px'}).each(function() {
          // read initial values from markup and remove that
          var value = parseInt( $( this ).text(), 10 );
          $( this ).empty().slider({
            value: value,
            range: "min",
            animate: true
            
          });
        });
        
        $("#slider-eq > span.ui-slider-purple").slider('disable');//disable third item
      
        
        $('#id-input-file-1 , #id-input-file-2').ace_file_input({
          no_file:'No File ...',
          btn_choose:'Choose',
          btn_change:'Change',
          droppable:false,
          onchange:null,
          thumbnail:false //| true | large
          //whitelist:'gif|png|jpg|jpeg'
          //blacklist:'exe|php'
          //onchange:''
          //
        });
        //pre-show a file name, for example a previously selected file
        //$('#id-input-file-1').ace_file_input('show_file_list', ['myfile.txt'])
      
      
        $('#id-input-file-3').ace_file_input({
          style: 'well',
          btn_choose: 'Drop files here or click to choose',
          btn_change: null,
          no_icon: 'ace-icon fa fa-cloud-upload',
          droppable: true,
          thumbnail: 'small'//large | fit
          //,icon_remove:null//set null, to hide remove/reset button
          /**,before_change:function(files, dropped) {
            //Check an example below
            //or examples/file-upload.html
            return true;
          }*/
          /**,before_remove : function() {
            return true;
          }*/
          ,
          preview_error : function(filename, error_code) {
            //name of the file that failed
            //error_code values
            //1 = 'FILE_LOAD_FAILED',
            //2 = 'IMAGE_LOAD_FAILED',
            //3 = 'THUMBNAIL_FAILED'
            //alert(error_code);
          }
      
        }).on('change', function(){
          //console.log($(this).data('ace_input_files'));
          //console.log($(this).data('ace_input_method'));
        });
        
        
        //$('#id-input-file-3')
        //.ace_file_input('show_file_list', [
          //{type: 'image', name: 'name of image', path: 'http://path/to/image/for/preview'},
          //{type: 'file', name: 'hello.txt'}
        //]);
      
        
        
      
        //dynamically change allowed formats by changing allowExt && allowMime function
        $('#id-file-format').removeAttr('checked').on('change', function() {
          var whitelist_ext, whitelist_mime;
          var btn_choose
          var no_icon
          if(this.checked) {
            btn_choose = "Drop images here or click to choose";
            no_icon = "ace-icon fa fa-picture-o";
      
            whitelist_ext = ["jpeg", "jpg", "png", "gif" , "bmp"];
            whitelist_mime = ["image/jpg", "image/jpeg", "image/png", "image/gif", "image/bmp"];
          }
          else {
            btn_choose = "Drop files here or click to choose";
            no_icon = "ace-icon fa fa-cloud-upload";
            
            whitelist_ext = null;//all extensions are acceptable
            whitelist_mime = null;//all mimes are acceptable
          }
          var file_input = $('#id-input-file-3');
          file_input
          .ace_file_input('update_settings',
          {
            'btn_choose': btn_choose,
            'no_icon': no_icon,
            'allowExt': whitelist_ext,
            'allowMime': whitelist_mime
          })
          file_input.ace_file_input('reset_input');
          
          file_input
          .off('file.error.ace')
          .on('file.error.ace', function(e, info) {
            //console.log(info.file_count);//number of selected files
            //console.log(info.invalid_count);//number of invalid files
            //console.log(info.error_list);//a list of errors in the following format
            
            //info.error_count['ext']
            //info.error_count['mime']
            //info.error_count['size']
            
            //info.error_list['ext']  = [list of file names with invalid extension]
            //info.error_list['mime'] = [list of file names with invalid mimetype]
            //info.error_list['size'] = [list of file names with invalid size]
            
            
            /**
            if( !info.dropped ) {
              //perhapse reset file field if files have been selected, and there are invalid files among them
              //when files are dropped, only valid files will be added to our file array
              e.preventDefault();//it will rest input
            }
            */
            
            
            //if files have been selected (not dropped), you can choose to reset input
            //because browser keeps all selected files anyway and this cannot be changed
            //we can only reset file field to become empty again
            //on any case you still should check files with your server side script
            //because any arbitrary file can be uploaded by user and it's not safe to rely on browser-side measures
          });
          
          
          /**
          file_input
          .off('file.preview.ace')
          .on('file.preview.ace', function(e, info) {
            console.log(info.file.width);
            console.log(info.file.height);
            e.preventDefault();//to prevent preview
          });
          */
        
        });
      
        $('#spinner1').ace_spinner({value:0,min:0,max:200,step:10, btn_up_class:'btn-info' , btn_down_class:'btn-info'})
        .closest('.ace-spinner')
        .on('changed.fu.spinbox', function(){
          //console.log($('#spinner1').val())
        }); 
        $('#spinner2').ace_spinner({value:0,min:0,max:10000,step:100, touch_spinner: true, icon_up:'ace-icon fa fa-caret-up bigger-110', icon_down:'ace-icon fa fa-caret-down bigger-110'});
        $('#spinner3').ace_spinner({value:0,min:-100,max:100,step:10, on_sides: true, icon_up:'ace-icon fa fa-plus bigger-110', icon_down:'ace-icon fa fa-minus bigger-110', btn_up_class:'btn-success' , btn_down_class:'btn-danger'});
        $('#spinner4').ace_spinner({value:0,min:-100,max:100,step:10, on_sides: true, icon_up:'ace-icon fa fa-plus', icon_down:'ace-icon fa fa-minus', btn_up_class:'btn-purple' , btn_down_class:'btn-purple'});
      
        //$('#spinner1').ace_spinner('disable').ace_spinner('value', 11);
        //or
        //$('#spinner1').closest('.ace-spinner').spinner('disable').spinner('enable').spinner('value', 11);//disable, enable or change value
        //$('#spinner1').closest('.ace-spinner').spinner('value', 0);//reset to 0
      
      
        //datepicker plugin
        //link
        $('.date-picker').datepicker({
          autoclose: true,
          todayHighlight: true
        })
        //show datepicker when clicking on the icon
        .next().on(ace.click_event, function(){
          $(this).prev().focus();
        });
      
        //or change it into a date range picker
        $('.input-daterange').datepicker({
          autoclose:true,
          format: 'yyyy-mm-dd',

        });
      
      
        //to translate the daterange picker, please copy the "examples/daterange-fr.js" contents here before initialization
        $('input[name=date-range-picker]').daterangepicker({
          'applyClass' : 'btn-sm btn-success',
          'cancelClass' : 'btn-sm btn-default',
          locale: {
            applyLabel: 'Aplicar',
            cancelLabel: 'Cancelar',
          }
        })
        .prev().on(ace.click_event, function(){
          $(this).next().focus();
        });
      
      
        $('#timepicker1').timepicker({
          autoclose:true,
          minuteStep: 1,
          showSeconds: true,
          showMeridian: false,
          disableFocus: true,
          icons: {
            up: 'fa fa-chevron-up',
            down: 'fa fa-chevron-down'
          }
        }).on('focus', function() {
          $('#timepicker1').timepicker('showWidget');
        }).next().on(ace.click_event, function(){
          $(this).prev().focus();
        });
        
        
      
        
        if(!ace.vars['old_ie']) $('#date-timepicker1').datetimepicker({
          
         format: 'YYYY-MM-DD H:mm:ss',//use this option to display seconds
         icons: {
          time: 'fa fa-clock-o',
          date: 'fa fa-calendar',
          up: 'fa fa-chevron-up',
          down: 'fa fa-chevron-down',
          previous: 'fa fa-chevron-left',
          next: 'fa fa-chevron-right',
          today: 'fa fa-arrows ',
          clear: 'fa fa-trash',
          close: 'fa fa-times'
         }
        }).next().on(ace.click_event, function(){
          $(this).prev().focus();
        });
        
      
        $('#colorpicker1').colorpicker();
        //$('.colorpicker').last().css('z-index', 2000);//if colorpicker is inside a modal, its z-index should be higher than modal'safe
      
        $('#simple-colorpicker-1').ace_colorpicker();
        //$('#simple-colorpicker-1').ace_colorpicker('pick', 2);//select 2nd color
        //$('#simple-colorpicker-1').ace_colorpicker('pick', '#fbe983');//select #fbe983 color
        //var picker = $('#simple-colorpicker-1').data('ace_colorpicker')
        //picker.pick('red', true);//insert the color if it doesn't exist
      
      
        $(".knob").knob();
        
        
        var tag_input = $('#form-field-tags');
        try{
          tag_input.tag(
            {
            placeholder:tag_input.attr('placeholder'),
            //enable typeahead by specifying the source array
            source: ace.vars['US_STATES'],//defined in ace.js >> ace.enable_search_ahead
            /**
            //or fetch data from database, fetch those that match "query"
            source: function(query, process) {
              $.ajax({url: 'remote_source.php?q='+encodeURIComponent(query)})
              .done(function(result_items){
              process(result_items);
              });
            }
            */
            }
          )
      
          //programmatically add/remove a tag
          var $tag_obj = $('#form-field-tags').data('tag');
          $tag_obj.add('Programmatically Added');
          
          var index = $tag_obj.inValues('some tag');
          $tag_obj.remove(index);
        }
        catch(e) {
          //display a textarea for old IE, because it doesn't support this plugin or another one I tried!
          tag_input.after('<textarea id="'+tag_input.attr('id')+'" name="'+tag_input.attr('name')+'" rows="3">'+tag_input.val()+'</textarea>').remove();
          //autosize($('#form-field-tags'));
        }
        
        
        /////////
        $('#modal-form input[type=file]').ace_file_input({
          style:'well',
          btn_choose:'Drop files here or click to choose',
          btn_change:null,
          no_icon:'ace-icon fa fa-cloud-upload',
          droppable:true,
          thumbnail:'large'
        })
        
        //chosen plugin inside a modal will have a zero width because the select element is originally hidden
        //and its width cannot be determined.
        //so we set the width after modal is show
        $('#modal-form').on('shown.bs.modal', function () {
          if(!ace.vars['touch']) {
            $(this).find('.chosen-container').each(function(){
              $(this).find('a:first-child').css('width' , '210px');
              $(this).find('.chosen-drop').css('width' , '210px');
              $(this).find('.chosen-search input').css('width' , '200px');
            });
          }
        })
        /**
        //or you can activate the chosen plugin after modal is shown
        //this way select element becomes visible with dimensions and chosen works as expected
        $('#modal-form').on('shown', function () {
          $(this).find('.modal-chosen').chosen();
        })
        */
      
        
        
        $(document).one('ajaxloadstart.page', function(e) {
          autosize.destroy('textarea[class*=autosize]')
          
          $('.limiterBox,.autosizejs').remove();
          $('.daterangepicker.dropdown-menu,.colorpicker.dropdown-menu,.bootstrap-datetimepicker-widget.dropdown-menu').remove();
        });
      
      });
    </script>
  </body>
</html>
