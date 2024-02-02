<?php 
$fecha_actual = date("Y-m-d");
$diasemana= date("N");


switch ($diasemana) {
    case "1":

$FechaInicioDia=($diaconsulta." 00:00:000");
$FechaFinalDia=($diaconsulta." 23:59:000");
  $hoy=date('Y-m-d');
        $diaconsulta=date("Y-m-d",strtotime($hoy."-1 days"));
        $fechadomingo8= ($diaconsulta." 08:00:000"); 
        $fechadomingo9= ($diaconsulta." 09:00:000"); 
        $fechadomingo10=($diaconsulta." 10:00:000"); 
        $fechadomingo11=($diaconsulta." 11:00:000"); 
        $fechadomingo12=($diaconsulta." 12:00:000");
        $fechadomingo13=($diaconsulta." 13:00:000");
        $fechadomingo14=($diaconsulta." 14:00:000");
        $fechadomingo15=($diaconsulta." 15:00:000");
        $fechadomingo16=($diaconsulta." 16:00:000");
        $fechadomingo17=($diaconsulta." 17:00:000");
        $fechadomingo18=($diaconsulta." 18:00:000");
        $fechadomingo19=($diaconsulta." 19:00:000");
        $fechadomingo20=($diaconsulta." 20:00:000");
        $fechadomingo21=($diaconsulta." 21:00:000");

        // Lunes
        //sumo 0 día
        $Lunes=date("Y-m-d",strtotime($fecha_actual."+ 0 days")); 

        $fechalunes8=   ($Lunes." 08:00:000");
        $fechalunes9=   ($Lunes." 09:00:000");
        $fechalunes10=  ($Lunes." 10:00:000");
        $fechalunes11=  ($Lunes." 11:00:000");
        $fechalunes12=  ($Lunes." 12:00:000");
        $fechalunes13=  ($Lunes." 13:00:000");
        $fechalunes14=  ($Lunes." 14:00:000");
        $fechalunes15=  ($Lunes." 15:00:000");
        $fechalunes16=  ($Lunes." 16:00:000");
        $fechalunes17=  ($Lunes." 17:00:000");
        $fechalunes18=  ($Lunes." 18:00:000");
        $fechalunes19=  ($Lunes." 19:00:000");
        $fechalunes20=  ($Lunes." 20:00:000");
        $fechalunes21=  ($Lunes." 21:00:000");


        // Martes
        //sumo 1 día
        $martes=date("Y-m-d",strtotime($fecha_actual."+ 1 days")); 
        $fechamartes8=   ($martes." 08:00:000");
        $fechamartes9=   ($martes." 09:00:000");
        $fechamartes10=  ($martes." 10:00:000");
        $fechamartes11=  ($martes." 11:00:000");
        $fechamartes12=  ($martes." 12:00:000");
        $fechamartes13=  ($martes." 13:00:000");
        $fechamartes14=  ($martes." 14:00:000");
        $fechamartes15=  ($martes." 15:00:000");
        $fechamartes16=  ($martes." 16:00:000");
        $fechamartes17=  ($martes." 17:00:000");
        $fechamartes18=  ($martes." 18:00:000");
        $fechamartes19=  ($martes." 19:00:000");
        $fechamartes20=  ($martes." 20:00:000");
        $fechamartes21=  ($martes." 21:00:000");

        // miercoles
         //sumo 1 día
        $miercoles=date("Y-m-d",strtotime($fecha_actual."+ 2 days")); 
        $fechamiercoles8=   ($miercoles." 08:00:000");
        $fechamiercoles9=   ($miercoles." 09:00:000");
        $fechamiercoles10=  ($miercoles." 10:00:000");
        $fechamiercoles11=  ($miercoles." 11:00:000");
        $fechamiercoles12=  ($miercoles." 12:00:000");
        $fechamiercoles13=  ($miercoles." 13:00:000");
        $fechamiercoles14=  ($miercoles." 14:00:000");
        $fechamiercoles15=  ($miercoles." 15:00:000");
        $fechamiercoles16=  ($miercoles." 16:00:000");
        $fechamiercoles17=  ($miercoles." 17:00:000");
        $fechamiercoles18=  ($miercoles." 18:00:000");
        $fechamiercoles19=  ($miercoles." 19:00:000");
        $fechamiercoles20=  ($miercoles." 20:00:000");
        $fechamiercoles21=  ($miercoles." 21:00:000");

        // jueves
         //sumo 1 día
        $jueves=date("Y-m-d",strtotime($fecha_actual."+ 3 days")); 
        $fechajueves8=   ($jueves." 08:00:000");
        $fechajueves9=   ($jueves." 09:00:000");
        $fechajueves10=  ($jueves." 10:00:000");
        $fechajueves11=  ($jueves." 11:00:000");
        $fechajueves12=  ($jueves." 12:00:000");
        $fechajueves13=  ($jueves." 13:00:000");
        $fechajueves14=  ($jueves." 14:00:000");
        $fechajueves15=  ($jueves." 15:00:000");
        $fechajueves16=  ($jueves." 16:00:000");
        $fechajueves17=  ($jueves." 17:00:000");
        $fechajueves18=  ($jueves." 18:00:000");
        $fechajueves19=  ($jueves." 19:00:000");
        $fechajueves20=  ($jueves." 20:00:000");
        $fechajueves21=  ($jueves." 21:00:000");

        // viernes
         //sumo 1 día
        $viernes=date("Y-m-d",strtotime($fecha_actual."+ 4 days")); 
        $fechaviernes8=   ($viernes." 08:00:000");
        $fechaviernes9=   ($viernes." 09:00:000");
        $fechaviernes10=  ($viernes." 10:00:000");
        $fechaviernes11=  ($viernes." 11:00:000");
        $fechaviernes12=  ($viernes." 12:00:000");
        $fechaviernes13=  ($viernes." 13:00:000");
        $fechaviernes14=  ($viernes." 14:00:000");
        $fechaviernes15=  ($viernes." 15:00:000");
        $fechaviernes16=  ($viernes." 16:00:000");
        $fechaviernes17=  ($viernes." 17:00:000");
        $fechaviernes18=  ($viernes." 18:00:000");
        $fechaviernes19=  ($viernes." 19:00:000");
        $fechaviernes20=  ($viernes." 20:00:000");
        $fechaviernes21=  ($viernes." 21:00:000");

        // sabado
         //sumo 1 día
        $sabado=date("Y-m-d",strtotime($fecha_actual."+ 5 days")); 
        $fechasabado8=   ($sabado." 08:00:000");
        $fechasabado9=   ($sabado." 09:00:000");
        $fechasabado10=  ($sabado." 10:00:000");
        $fechasabado11=  ($sabado." 11:00:000");
        $fechasabado12=  ($sabado." 12:00:000");
        $fechasabado13=  ($sabado." 13:00:000");
        $fechasabado14=  ($sabado." 14:00:000");
        $fechasabado15=  ($sabado." 15:00:000");
        $fechasabado16=  ($sabado." 16:00:000");
        $fechasabado17=  ($sabado." 17:00:000");
        $fechasabado18=  ($sabado." 18:00:000");
        $fechasabado19=  ($sabado." 19:00:000");
        $fechasabado20=  ($sabado." 20:00:000");
        $fechasabado21=  ($sabado." 21:00:000");

        break;

    case "2": // SI EL DIA DE LA CONSULTA ES LUNES

$FechaInicioDia=($diaconsulta." 00:00:000");
$FechaFinalDia=($diaconsulta." 23:59:000");

        $domingo=date("Y-m-d",strtotime($fecha_actual."- 2 days")); 
        $fechadomingo8= ($domingo." 08:00:000");
        $fechadomingo9= ($domingo." 09:00:000");
        $fechadomingo10=($domingo." 10:00:000");
        $fechadomingo11=($domingo." 11:00:000");
        $fechadomingo12=($domingo." 12:00:000");
        $fechadomingo13=($domingo." 13:00:000");
        $fechadomingo14=($domingo." 14:00:000");
        $fechadomingo15=($domingo." 15:00:000");
        $fechadomingo16=($domingo." 16:00:000");
        $fechadomingo17=($domingo." 17:00:000");
        $fechadomingo18=($domingo." 18:00:000");
        $fechadomingo19=($domingo." 19:00:000");
        $fechadomingo20=($domingo." 20:00:000");
        $fechadomingo21=($domingo." 21:00:000");

        // Lunes
        //sumo 0 días
  $hoy=date('Y-m-d');
        $diaconsulta=date("Y-m-d",strtotime($hoy."-1 days"));
        $fechalunes8=   ($diaconsulta." 08:00:000");
        $fechalunes9=   ($diaconsulta." 09:00:000");
        $fechalunes10=  ($diaconsulta." 10:00:000");
        $fechalunes11=  ($diaconsulta." 11:00:000");
        $fechalunes12=  ($diaconsulta." 12:00:000");
        $fechalunes13=  ($diaconsulta." 13:00:000");
        $fechalunes14=  ($diaconsulta." 14:00:000");
        $fechalunes15=  ($diaconsulta." 15:00:000");
        $fechalunes16=  ($diaconsulta." 16:00:000");
        $fechalunes17=  ($diaconsulta." 17:00:000");
        $fechalunes18=  ($diaconsulta." 18:00:000");
        $fechalunes19=  ($diaconsulta." 19:00:000");
        $fechalunes20=  ($diaconsulta." 20:00:000");
        $fechalunes21=  ($diaconsulta." 21:00:000");


        // Martes
        //sumo 1 día
        $martes=date("Y-m-d",strtotime($fecha_actual."+ 0 days")); 
        $fechamartes8=   ($martes." 08:00:000");
        $fechamartes9=   ($martes." 09:00:000");
        $fechamartes10=  ($martes." 10:00:000");
        $fechamartes11=  ($martes." 11:00:000");
        $fechamartes12=  ($martes." 12:00:000");
        $fechamartes13=  ($martes." 13:00:000");
        $fechamartes14=  ($martes." 14:00:000");
        $fechamartes15=  ($martes." 15:00:000");
        $fechamartes16=  ($martes." 16:00:000");
        $fechamartes17=  ($martes." 17:00:000");
        $fechamartes18=  ($martes." 18:00:000");
        $fechamartes19=  ($martes." 19:00:000");
        $fechamartes20=  ($martes." 20:00:000");
        $fechamartes21=  ($martes." 21:00:000");

        // miercoles
         //sumo 1 día
        $miercoles=date("Y-m-d",strtotime($fecha_actual."+ 1 days")); 
        $fechamiercoles8=   ($miercoles." 08:00:000");
        $fechamiercoles9=   ($miercoles." 09:00:000");
        $fechamiercoles10=  ($miercoles." 10:00:000");
        $fechamiercoles11=  ($miercoles." 11:00:000");
        $fechamiercoles12=  ($miercoles." 12:00:000");
        $fechamiercoles13=  ($miercoles." 13:00:000");
        $fechamiercoles14=  ($miercoles." 14:00:000");
        $fechamiercoles15=  ($miercoles." 15:00:000");
        $fechamiercoles16=  ($miercoles." 16:00:000");
        $fechamiercoles17=  ($miercoles." 17:00:000");
        $fechamiercoles18=  ($miercoles." 18:00:000");
        $fechamiercoles19=  ($miercoles." 19:00:000");
        $fechamiercoles20=  ($miercoles." 20:00:000");
        $fechamiercoles21=  ($miercoles." 21:00:000");

        // jueves
         //sumo 1 día
        $jueves=date("Y-m-d",strtotime($fecha_actual."+ 2 days")); 
        $fechajueves8=   ($jueves." 08:00:000");
        $fechajueves9=   ($jueves." 09:00:000");
        $fechajueves10=  ($jueves." 10:00:000");
        $fechajueves11=  ($jueves." 11:00:000");
        $fechajueves12=  ($jueves." 12:00:000");
        $fechajueves13=  ($jueves." 13:00:000");
        $fechajueves14=  ($jueves." 14:00:000");
        $fechajueves15=  ($jueves." 15:00:000");
        $fechajueves16=  ($jueves." 16:00:000");
        $fechajueves17=  ($jueves." 17:00:000");
        $fechajueves18=  ($jueves." 18:00:000");
        $fechajueves19=  ($jueves." 19:00:000");
        $fechajueves20=  ($jueves." 20:00:000");
        $fechajueves21=  ($jueves." 21:00:000");

        // viernes
         //sumo 1 día
        $viernes=date("Y-m-d",strtotime($fecha_actual."+ 3 days")); 
        $fechaviernes8=   ($viernes." 08:00:000");
        $fechaviernes9=   ($viernes." 09:00:000");
        $fechaviernes10=  ($viernes." 10:00:000");
        $fechaviernes11=  ($viernes." 11:00:000");
        $fechaviernes12=  ($viernes." 12:00:000");
        $fechaviernes13=  ($viernes." 13:00:000");
        $fechaviernes14=  ($viernes." 14:00:000");
        $fechaviernes15=  ($viernes." 15:00:000");
        $fechaviernes16=  ($viernes." 16:00:000");
        $fechaviernes17=  ($viernes." 17:00:000");
        $fechaviernes18=  ($viernes." 18:00:000");
        $fechaviernes19=  ($viernes." 19:00:000");
        $fechaviernes20=  ($viernes." 20:00:000");
        $fechaviernes21=  ($viernes." 21:00:000");

        // sabado
         //sumo 1 día
        $sabado=date("Y-m-d",strtotime($fecha_actual."+ 4 days")); 
        $fechasabado8=   ($sabado." 08:00:000");
        $fechasabado9=   ($sabado." 09:00:000");
        $fechasabado10=  ($sabado." 10:00:000");
        $fechasabado11=  ($sabado." 11:00:000");
        $fechasabado12=  ($sabado." 12:00:000");
        $fechasabado13=  ($sabado." 13:00:000");
        $fechasabado14=  ($sabado." 14:00:000");
        $fechasabado15=  ($sabado." 15:00:000");
        $fechasabado16=  ($sabado." 16:00:000");
        $fechasabado17=  ($sabado." 17:00:000");
        $fechasabado18=  ($sabado." 18:00:000");
        $fechasabado19=  ($sabado." 19:00:000");
        $fechasabado20=  ($sabado." 20:00:000");
        $fechasabado21=  ($sabado." 21:00:000");
        break;

    case "3": // SI EL DIA ACTUAL ES MARTES

$diaconsulta = date('Y-m-d');
$FechaInicioDia=($diaconsulta." 00:00:000");
$FechaFinalDia=($diaconsulta." 23:59:000");

       $domingo=date("Y-m-d",strtotime($fecha_actual."- 3 days")); 
        $fechadomingo8= ($domingo." 08:00:000");
        $fechadomingo9= ($domingo." 09:00:000");
        $fechadomingo10=($domingo." 10:00:000");
        $fechadomingo11=($domingo." 11:00:000");
        $fechadomingo12=($domingo." 12:00:000");
        $fechadomingo13=($domingo." 13:00:000");
        $fechadomingo14=($domingo." 14:00:000");
        $fechadomingo15=($domingo." 15:00:000");
        $fechadomingo16=($domingo." 16:00:000");
        $fechadomingo17=($domingo." 17:00:000");
        $fechadomingo18=($domingo." 18:00:000");
        $fechadomingo19=($domingo." 19:00:000");
        $fechadomingo20=($domingo." 20:00:000");
        $fechadomingo21=($domingo." 21:00:000");

        // Lunes
        
        $lunes=date("Y-m-d",strtotime($fecha_actual."- 2 days"));

        $fechalunes8=   ($lunes." 08:00:000");
        $fechalunes9=   ($lunes." 09:00:000");
        $fechalunes10=  ($lunes." 10:00:000");
        $fechalunes11=  ($lunes." 11:00:000");
        $fechalunes12=  ($lunes." 12:00:000");
        $fechalunes13=  ($lunes." 13:00:000");
        $fechalunes14=  ($lunes." 14:00:000");
        $fechalunes15=  ($lunes." 15:00:000");
        $fechalunes16=  ($lunes." 16:00:000");
        $fechalunes17=  ($lunes." 17:00:000");
        $fechalunes18=  ($lunes." 18:00:000");
        $fechalunes19=  ($lunes." 19:00:000");
        $fechalunes20=  ($lunes." 20:00:000");
        $fechalunes21=  ($lunes." 21:00:000");


        // Martes
        //sumo 1 día
  $hoy=date('Y-m-d');
        $diaconsulta=date("Y-m-d",strtotime($hoy."-1 days"));
        $fechamartes8=   ($diaconsulta." 08:00:000");
        $fechamartes9=   ($diaconsulta." 09:00:000");
        $fechamartes10=  ($diaconsulta." 10:00:000");
        $fechamartes11=  ($diaconsulta." 11:00:000");
        $fechamartes12=  ($diaconsulta." 12:00:000");
        $fechamartes13=  ($diaconsulta." 13:00:000");
        $fechamartes14=  ($diaconsulta." 14:00:000");
        $fechamartes15=  ($diaconsulta." 15:00:000");
        $fechamartes16=  ($diaconsulta." 16:00:000");
        $fechamartes17=  ($diaconsulta." 17:00:000");
        $fechamartes18=  ($diaconsulta." 18:00:000");
        $fechamartes19=  ($diaconsulta." 19:00:000");
        $fechamartes20=  ($diaconsulta." 20:00:000");
        $fechamartes21=  ($diaconsulta." 21:00:000");

        // miercoles
         //sumo 1 día
        $miercoles=date("Y-m-d",strtotime($fecha_actual."+ 0 days")); 
        $fechamiercoles8=   ($miercoles." 08:00:000");
        $fechamiercoles9=   ($miercoles." 09:00:000");
        $fechamiercoles10=  ($miercoles." 10:00:000");
        $fechamiercoles11=  ($miercoles." 11:00:000");
        $fechamiercoles12=  ($miercoles." 12:00:000");
        $fechamiercoles13=  ($miercoles." 13:00:000");
        $fechamiercoles14=  ($miercoles." 14:00:000");
        $fechamiercoles15=  ($miercoles." 15:00:000");
        $fechamiercoles16=  ($miercoles." 16:00:000");
        $fechamiercoles17=  ($miercoles." 17:00:000");
        $fechamiercoles18=  ($miercoles." 18:00:000");
        $fechamiercoles19=  ($miercoles." 19:00:000");
        $fechamiercoles20=  ($miercoles." 20:00:000");
        $fechamiercoles21=  ($miercoles." 21:00:000");

        // jueves
         //sumo 1 día
        $jueves=date("Y-m-d",strtotime($fecha_actual."+ 1 days")); 
        $fechajueves8=   ($jueves." 08:00:000");
        $fechajueves9=   ($jueves." 09:00:000");
        $fechajueves10=  ($jueves." 10:00:000");
        $fechajueves11=  ($jueves." 11:00:000");
        $fechajueves12=  ($jueves." 12:00:000");
        $fechajueves13=  ($jueves." 13:00:000");
        $fechajueves14=  ($jueves." 14:00:000");
        $fechajueves15=  ($jueves." 15:00:000");
        $fechajueves16=  ($jueves." 16:00:000");
        $fechajueves17=  ($jueves." 17:00:000");
        $fechajueves18=  ($jueves." 18:00:000");
        $fechajueves19=  ($jueves." 19:00:000");
        $fechajueves20=  ($jueves." 20:00:000");
        $fechajueves21=  ($jueves." 21:00:000");

        // viernes
         //sumo 1 día
        $viernes=date("Y-m-d",strtotime($fecha_actual."+ 2 days")); 
        $fechaviernes8=   ($viernes." 08:00:000");
        $fechaviernes9=   ($viernes." 09:00:000");
        $fechaviernes10=  ($viernes." 10:00:000");
        $fechaviernes11=  ($viernes." 11:00:000");
        $fechaviernes12=  ($viernes." 12:00:000");
        $fechaviernes13=  ($viernes." 13:00:000");
        $fechaviernes14=  ($viernes." 14:00:000");
        $fechaviernes15=  ($viernes." 15:00:000");
        $fechaviernes16=  ($viernes." 16:00:000");
        $fechaviernes17=  ($viernes." 17:00:000");
        $fechaviernes18=  ($viernes." 18:00:000");
        $fechaviernes19=  ($viernes." 19:00:000");
        $fechaviernes20=  ($viernes." 20:00:000");
        $fechaviernes21=  ($viernes." 21:00:000");

        // sabado
         //sumo 1 día
        $sabado=date("Y-m-d",strtotime($fecha_actual."+ 3 days")); 
        $fechasabado8=   ($sabado." 08:00:000");
        $fechasabado9=   ($sabado." 09:00:000");
        $fechasabado10=  ($sabado." 10:00:000");
        $fechasabado11=  ($sabado." 11:00:000");
        $fechasabado12=  ($sabado." 12:00:000");
        $fechasabado13=  ($sabado." 13:00:000");
        $fechasabado14=  ($sabado." 14:00:000");
        $fechasabado15=  ($sabado." 15:00:000");
        $fechasabado16=  ($sabado." 16:00:000");
        $fechasabado17=  ($sabado." 17:00:000");
        $fechasabado18=  ($sabado." 18:00:000");
        $fechasabado19=  ($sabado." 19:00:000");
        $fechasabado20=  ($sabado." 20:00:000");
        $fechasabado21=  ($sabado." 21:00:000");
        break;


        case "4": // SI EL DIA ACTUAL ES UN MIÉRCOLES


$FechaInicioDia=($diaconsulta." 00:00:000");
$FechaFinalDia=($diaconsulta." 23:59:000");

        $domingo=date("Y-m-d",strtotime($fecha_actual."- 4 days")); 
        $fechadomingo8= ($domingo." 08:00:000");
        $fechadomingo9= ($domingo." 09:00:000");
        $fechadomingo10=($domingo." 10:00:000");
        $fechadomingo11=($domingo." 11:00:000");
        $fechadomingo12=($domingo." 12:00:000");
        $fechadomingo13=($domingo." 13:00:000");
        $fechadomingo14=($domingo." 14:00:000");
        $fechadomingo15=($domingo." 15:00:000");
        $fechadomingo16=($domingo." 16:00:000");
        $fechadomingo17=($domingo." 17:00:000");
        $fechadomingo18=($domingo." 18:00:000");
        $fechadomingo19=($domingo." 19:00:000");
        $fechadomingo20=($domingo." 20:00:000");
        $fechadomingo21=($domingo." 21:00:000");

        // Lunes
        
        $lunes=date("Y-m-d",strtotime($fecha_actual."- 3 days"));

        $fechalunes8=   ($lunes." 08:00:000");
        $fechalunes9=   ($lunes." 09:00:000");
        $fechalunes10=  ($lunes." 10:00:000");
        $fechalunes11=  ($lunes." 11:00:000");
        $fechalunes12=  ($lunes." 12:00:000");
        $fechalunes13=  ($lunes." 13:00:000");
        $fechalunes14=  ($lunes." 14:00:000");
        $fechalunes15=  ($lunes." 15:00:000");
        $fechalunes16=  ($lunes." 16:00:000");
        $fechalunes17=  ($lunes." 17:00:000");
        $fechalunes18=  ($lunes." 18:00:000");
        $fechalunes19=  ($lunes." 19:00:000");
        $fechalunes20=  ($lunes." 20:00:000");
        $fechalunes21=  ($lunes." 21:00:000");


        // Martes
        //sumo 1 día
        
        $martes=date("Y-m-d",strtotime($fecha_actual."- 2 days"));
        $fechamartes8=   ($martes." 08:00:000");
        $fechamartes9=   ($martes." 09:00:000");
        $fechamartes10=  ($martes." 10:00:000");
        $fechamartes11=  ($martes." 11:00:000");
        $fechamartes12=  ($martes." 12:00:000");
        $fechamartes13=  ($martes." 13:00:000");
        $fechamartes14=  ($martes." 14:00:000");
        $fechamartes15=  ($martes." 15:00:000");
        $fechamartes16=  ($martes." 16:00:000");
        $fechamartes17=  ($martes." 17:00:000");
        $fechamartes18=  ($martes." 18:00:000");
        $fechamartes19=  ($martes." 19:00:000");
        $fechamartes20=  ($martes." 20:00:000");
        $fechamartes21=  ($martes." 21:00:000");

        // miercoles
        $hoy=date('Y-m-d');
        $diaconsulta=date("Y-m-d",strtotime($hoy."-1 days")); 
        $fechamiercoles8=   ($diaconsulta." 08:00:000"); 
        $fechamiercoles9=   ($diaconsulta." 09:00:000");
        $fechamiercoles10=  ($diaconsulta." 10:00:000");
        $fechamiercoles11=  ($diaconsulta." 11:00:000");
        $fechamiercoles12=  ($diaconsulta." 12:00:000");
        $fechamiercoles13=  ($diaconsulta." 13:00:000");
        $fechamiercoles14=  ($diaconsulta." 14:00:000");
        $fechamiercoles15=  ($diaconsulta." 15:00:000");
        $fechamiercoles16=  ($diaconsulta." 16:00:000");
        $fechamiercoles17=  ($diaconsulta." 17:00:000");
        $fechamiercoles18=  ($diaconsulta." 18:00:000");
        $fechamiercoles19=  ($diaconsulta." 19:00:000");
        $fechamiercoles20=  ($diaconsulta." 20:00:000");
        $fechamiercoles21=  ($diaconsulta." 21:00:000");

        // jueves
         //sumo 1 día
        $jueves=date("Y-m-d",strtotime($fecha_actual."+ 0 days")); 
        $fechajueves8=   ($jueves." 08:00:000");
        $fechajueves9=   ($jueves." 09:00:000");
        $fechajueves10=  ($jueves." 10:00:000");
        $fechajueves11=  ($jueves." 11:00:000");
        $fechajueves12=  ($jueves." 12:00:000");
        $fechajueves13=  ($jueves." 13:00:000");
        $fechajueves14=  ($jueves." 14:00:000");
        $fechajueves15=  ($jueves." 15:00:000");
        $fechajueves16=  ($jueves." 16:00:000");
        $fechajueves17=  ($jueves." 17:00:000");
        $fechajueves18=  ($jueves." 18:00:000");
        $fechajueves19=  ($jueves." 19:00:000");
        $fechajueves20=  ($jueves." 20:00:000");
        $fechajueves21=  ($jueves." 21:00:000");

        // viernes
         //sumo 1 día
        $viernes=date("Y-m-d",strtotime($fecha_actual."+ 1 days")); 
        $fechaviernes8=   ($viernes." 08:00:000");
        $fechaviernes9=   ($viernes." 09:00:000");
        $fechaviernes10=  ($viernes." 10:00:000");
        $fechaviernes11=  ($viernes." 11:00:000");
        $fechaviernes12=  ($viernes." 12:00:000");
        $fechaviernes13=  ($viernes." 13:00:000");
        $fechaviernes14=  ($viernes." 14:00:000");
        $fechaviernes15=  ($viernes." 15:00:000");
        $fechaviernes16=  ($viernes." 16:00:000");
        $fechaviernes17=  ($viernes." 17:00:000");
        $fechaviernes18=  ($viernes." 18:00:000");
        $fechaviernes19=  ($viernes." 19:00:000");
        $fechaviernes20=  ($viernes." 20:00:000");
        $fechaviernes21=  ($viernes." 21:00:000");

        // sabado
         //sumo 1 día
        $sabado=date("Y-m-d",strtotime($fecha_actual."+ 2 days")); 
        $fechasabado8=   ($sabado." 08:00:000");
        $fechasabado9=   ($sabado." 09:00:000");
        $fechasabado10=  ($sabado." 10:00:000");
        $fechasabado11=  ($sabado." 11:00:000");
        $fechasabado12=  ($sabado." 12:00:000");
        $fechasabado13=  ($sabado." 13:00:000");
        $fechasabado14=  ($sabado." 14:00:000");
        $fechasabado15=  ($sabado." 15:00:000");
        $fechasabado16=  ($sabado." 16:00:000");
        $fechasabado17=  ($sabado." 17:00:000");
        $fechasabado18=  ($sabado." 18:00:000");
        $fechasabado19=  ($sabado." 19:00:000");
        $fechasabado20=  ($sabado." 20:00:000");
        $fechasabado21=  ($sabado." 21:00:000");

        break;

        case "5": // SI EL DIA ACTUAL ES UN JUEVES

$diaconsulta = date('Y-m-d');
$FechaInicioDia=($diaconsulta." 00:00:000");
$FechaFinalDia=($diaconsulta." 23:59:000");

        $domingo=date("Y-m-d",strtotime($fecha_actual."- 5 days"));
        $fechadomingo8= ($domingo." 08:00:000");
        $fechadomingo9= ($domingo." 09:00:000");
        $fechadomingo10=($domingo." 10:00:000");
        $fechadomingo11=($domingo." 11:00:000");
        $fechadomingo12=($domingo." 12:00:000");
        $fechadomingo13=($domingo." 13:00:000");
        $fechadomingo14=($domingo." 14:00:000");
        $fechadomingo15=($domingo." 15:00:000");
        $fechadomingo16=($domingo." 16:00:000");
        $fechadomingo17=($domingo." 17:00:000");
        $fechadomingo18=($domingo." 18:00:000");
        $fechadomingo19=($domingo." 19:00:000");
        $fechadomingo20=($domingo." 20:00:000");
        $fechadomingo21=($domingo." 21:00:000");

        // Lunes
        
        $lunes=date("Y-m-d",strtotime($fecha_actual."- 4 days"));

        $fechalunes8=   ($lunes." 08:00:000");
        $fechalunes9=   ($lunes." 09:00:000");
        $fechalunes10=  ($lunes." 10:00:000");
        $fechalunes11=  ($lunes." 11:00:000");
        $fechalunes12=  ($lunes." 12:00:000");
        $fechalunes13=  ($lunes." 13:00:000");
        $fechalunes14=  ($lunes." 14:00:000");
        $fechalunes15=  ($lunes." 15:00:000");
        $fechalunes16=  ($lunes." 16:00:000");
        $fechalunes17=  ($lunes." 17:00:000");
        $fechalunes18=  ($lunes." 18:00:000");
        $fechalunes19=  ($lunes." 19:00:000");
        $fechalunes20=  ($lunes." 20:00:000");
        $fechalunes21=  ($lunes." 21:00:000");


        // Martes
        //sumo 1 día
        
        $martes=date("Y-m-d",strtotime($fecha_actual."- 3 days"));
        $fechamartes8=   ($martes." 08:00:000");
        $fechamartes9=   ($martes." 09:00:000");
        $fechamartes10=  ($martes." 10:00:000");
        $fechamartes11=  ($martes." 11:00:000");
        $fechamartes12=  ($martes." 12:00:000");
        $fechamartes13=  ($martes." 13:00:000");
        $fechamartes14=  ($martes." 14:00:000");
        $fechamartes15=  ($martes." 15:00:000");
        $fechamartes16=  ($martes." 16:00:000");
        $fechamartes17=  ($martes." 17:00:000");
        $fechamartes18=  ($martes." 18:00:000");
        $fechamartes19=  ($martes." 19:00:000");
        $fechamartes20=  ($martes." 20:00:000");
        $fechamartes21=  ($martes." 21:00:000");

        // miercoles
        
        $miercoles=date("Y-m-d",strtotime($fecha_actual."- 2 days"));
        $fechamiercoles8=   ($miercoles." 08:00:000");
        $fechamiercoles9=   ($miercoles." 09:00:000");
        $fechamiercoles10=  ($miercoles." 10:00:000");
        $fechamiercoles11=  ($miercoles." 11:00:000");
        $fechamiercoles12=  ($miercoles." 12:00:000");
        $fechamiercoles13=  ($miercoles." 13:00:000");
        $fechamiercoles14=  ($miercoles." 14:00:000");
        $fechamiercoles15=  ($miercoles." 15:00:000");
        $fechamiercoles16=  ($miercoles." 16:00:000");
        $fechamiercoles17=  ($miercoles." 17:00:000");
        $fechamiercoles18=  ($miercoles." 18:00:000");
        $fechamiercoles19=  ($miercoles." 19:00:000");
        $fechamiercoles20=  ($miercoles." 20:00:000");
        $fechamiercoles21=  ($miercoles." 21:00:000");

        // jueves
          $hoy=date('Y-m-d');
        $diaconsulta=date("Y-m-d",strtotime($hoy."-1 days"));
        $fechajueves8=   ($diaconsulta." 08:00:000");
        $fechajueves9=   ($diaconsulta." 09:00:000");
        $fechajueves10=  ($diaconsulta." 10:00:000");
        $fechajueves11=  ($diaconsulta." 11:00:000");
        $fechajueves12=  ($diaconsulta." 12:00:000");
        $fechajueves13=  ($diaconsulta." 13:00:000");
        $fechajueves14=  ($diaconsulta." 14:00:000");
        $fechajueves15=  ($diaconsulta." 15:00:000");
        $fechajueves16=  ($diaconsulta." 16:00:000");
        $fechajueves17=  ($diaconsulta." 17:00:000");
        $fechajueves18=  ($diaconsulta." 18:00:000");
        $fechajueves19=  ($diaconsulta." 19:00:000");
        $fechajueves20=  ($diaconsulta." 20:00:000");
        $fechajueves21=  ($diaconsulta." 21:00:000");

        // viernes
         //sumo 1 día
        $viernes=date("Y-m-d",strtotime($fecha_actual."+ 0 days")); 
        $fechaviernes8=   ($viernes." 08:00:000");
        $fechaviernes9=   ($viernes." 09:00:000");
        $fechaviernes10=  ($viernes." 10:00:000");
        $fechaviernes11=  ($viernes." 11:00:000");
        $fechaviernes12=  ($viernes." 12:00:000");
        $fechaviernes13=  ($viernes." 13:00:000");
        $fechaviernes14=  ($viernes." 14:00:000");
        $fechaviernes15=  ($viernes." 15:00:000");
        $fechaviernes16=  ($viernes." 16:00:000");
        $fechaviernes17=  ($viernes." 17:00:000");
        $fechaviernes18=  ($viernes." 18:00:000");
        $fechaviernes19=  ($viernes." 19:00:000");
        $fechaviernes20=  ($viernes." 20:00:000");
        $fechaviernes21=  ($viernes." 21:00:000");

        // sabado
         //sumo 1 día
        $sabado=date("Y-m-d",strtotime($fecha_actual."+ 1 days")); 
        $fechasabado8=   ($sabado." 08:00:000");
        $fechasabado9=   ($sabado." 09:00:000");
        $fechasabado10=  ($sabado." 10:00:000");
        $fechasabado11=  ($sabado." 11:00:000");
        $fechasabado12=  ($sabado." 12:00:000");
        $fechasabado13=  ($sabado." 13:00:000");
        $fechasabado14=  ($sabado." 14:00:000");
        $fechasabado15=  ($sabado." 15:00:000");
        $fechasabado16=  ($sabado." 16:00:000");
        $fechasabado17=  ($sabado." 17:00:000");
        $fechasabado18=  ($sabado." 18:00:000");
        $fechasabado19=  ($sabado." 19:00:000");
        $fechasabado20=  ($sabado." 20:00:000");
        $fechasabado21=  ($sabado." 21:00:000");
        break;

        case "6": // SI EL DIA ACTUAL ES UN VIERNES

$diaconsulta = date('Y-m-d');
$FechaInicioDia=($diaconsulta." 00:00:000");
$FechaFinalDia=($diaconsulta." 23:59:000");

        $domingo=date("Y-m-d",strtotime($fecha_actual."- 6 days")); 
        $fechadomingo8= ($domingo." 08:00:000");
        $fechadomingo9= ($domingo." 09:00:000");
        $fechadomingo10=($domingo." 10:00:000");
        $fechadomingo11=($domingo." 11:00:000");
        $fechadomingo12=($domingo." 12:00:000");
        $fechadomingo13=($domingo." 13:00:000");
        $fechadomingo14=($domingo." 14:00:000");
        $fechadomingo15=($domingo." 15:00:000");
        $fechadomingo16=($domingo." 16:00:000");
        $fechadomingo17=($domingo." 17:00:000");
        $fechadomingo18=($domingo." 18:00:000");
        $fechadomingo19=($domingo." 19:00:000");
        $fechadomingo20=($domingo." 20:00:000");
        $fechadomingo21=($domingo." 21:00:000");

        // Lunes
        
        $lunes=date("Y-m-d",strtotime($fecha_actual."- 5 days"));

        $fechalunes8=   ($lunes." 08:00:000");
        $fechalunes9=   ($lunes." 09:00:000");
        $fechalunes10=  ($lunes." 10:00:000");
        $fechalunes11=  ($lunes." 11:00:000");
        $fechalunes12=  ($lunes." 12:00:000");
        $fechalunes13=  ($lunes." 13:00:000");
        $fechalunes14=  ($lunes." 14:00:000");
        $fechalunes15=  ($lunes." 15:00:000");
        $fechalunes16=  ($lunes." 16:00:000");
        $fechalunes17=  ($lunes." 17:00:000");
        $fechalunes18=  ($lunes." 18:00:000");
        $fechalunes19=  ($lunes." 19:00:000");
        $fechalunes20=  ($lunes." 20:00:000");
        $fechalunes21=  ($lunes." 21:00:000");


        // Martes
        //sumo 1 día
        
        $martes=date("Y-m-d",strtotime($fecha_actual."- 4 days"));
        $fechamartes8=   ($martes." 08:00:000");
        $fechamartes9=   ($martes." 09:00:000");
        $fechamartes10=  ($martes." 10:00:000");
        $fechamartes11=  ($martes." 11:00:000");
        $fechamartes12=  ($martes." 12:00:000");
        $fechamartes13=  ($martes." 13:00:000");
        $fechamartes14=  ($martes." 14:00:000");
        $fechamartes15=  ($martes." 15:00:000");
        $fechamartes16=  ($martes." 16:00:000");
        $fechamartes17=  ($martes." 17:00:000");
        $fechamartes18=  ($martes." 18:00:000");
        $fechamartes19=  ($martes." 19:00:000");
        $fechamartes20=  ($martes." 20:00:000");
        $fechamartes21=  ($martes." 21:00:000");

        // miercoles
        
        $miercoles=date("Y-m-d",strtotime($fecha_actual."- 3 days"));
        $fechamiercoles8=   ($miercoles." 08:00:000");
        $fechamiercoles9=   ($miercoles." 09:00:000");
        $fechamiercoles10=  ($miercoles." 10:00:000");
        $fechamiercoles11=  ($miercoles." 11:00:000");
        $fechamiercoles12=  ($miercoles." 12:00:000");
        $fechamiercoles13=  ($miercoles." 13:00:000");
        $fechamiercoles14=  ($miercoles." 14:00:000");
        $fechamiercoles15=  ($miercoles." 15:00:000");
        $fechamiercoles16=  ($miercoles." 16:00:000");
        $fechamiercoles17=  ($miercoles." 17:00:000");
        $fechamiercoles18=  ($miercoles." 18:00:000");
        $fechamiercoles19=  ($miercoles." 19:00:000");
        $fechamiercoles20=  ($miercoles." 20:00:000");
        $fechamiercoles21=  ($miercoles." 21:00:000");

        // jueves
        $jueves=date("Y-m-d",strtotime($fecha_actual."- 2 days"));
        $fechajueves8=   ($jueves." 08:00:000");
        $fechajueves9=   ($jueves." 09:00:000");
        $fechajueves10=  ($jueves." 10:00:000");
        $fechajueves11=  ($jueves." 11:00:000");
        $fechajueves12=  ($jueves." 12:00:000");
        $fechajueves13=  ($jueves." 13:00:000");
        $fechajueves14=  ($jueves." 14:00:000");
        $fechajueves15=  ($jueves." 15:00:000");
        $fechajueves16=  ($jueves." 16:00:000");
        $fechajueves17=  ($jueves." 17:00:000");
        $fechajueves18=  ($jueves." 18:00:000");
        $fechajueves19=  ($jueves." 19:00:000");
        $fechajueves20=  ($jueves." 20:00:000");
        $fechajueves21=  ($jueves." 21:00:000");

        // viernes
         //sumo 1 día
          $hoy=date('Y-m-d');
        $diaconsulta=date("Y-m-d",strtotime($hoy."-1 days"));
        $fechaviernes8=   ($diaconsulta." 08:00:000");
        $fechaviernes9=   ($diaconsulta." 09:00:000");
        $fechaviernes10=  ($diaconsulta." 10:00:000");
        $fechaviernes11=  ($diaconsulta." 11:00:000");
        $fechaviernes12=  ($diaconsulta." 12:00:000");
        $fechaviernes13=  ($diaconsulta." 13:00:000");
        $fechaviernes14=  ($diaconsulta." 14:00:000");
        $fechaviernes15=  ($diaconsulta." 15:00:000");
        $fechaviernes16=  ($diaconsulta." 16:00:000");
        $fechaviernes17=  ($diaconsulta." 17:00:000");
        $fechaviernes18=  ($diaconsulta." 18:00:000");
        $fechaviernes19=  ($diaconsulta." 19:00:000");
        $fechaviernes20=  ($diaconsulta." 20:00:000");
        $fechaviernes21=  ($diaconsulta." 21:00:000");

        // sabado
         //sumo 1 día
        $sabado=date("Y-m-d",strtotime($fecha_actual."+ 0 days")); 
        $fechasabado8=   ($sabado." 08:00:000");
        $fechasabado9=   ($sabado." 09:00:000");
        $fechasabado10=  ($sabado." 10:00:000");
        $fechasabado11=  ($sabado." 11:00:000");
        $fechasabado12=  ($sabado." 12:00:000");
        $fechasabado13=  ($sabado." 13:00:000");
        $fechasabado14=  ($sabado." 14:00:000");
        $fechasabado15=  ($sabado." 15:00:000");
        $fechasabado16=  ($sabado." 16:00:000");
        $fechasabado17=  ($sabado." 17:00:000");
        $fechasabado18=  ($sabado." 18:00:000");
        $fechasabado19=  ($sabado." 19:00:000");
        $fechasabado20=  ($sabado." 20:00:000");
        $fechasabado21=  ($sabado." 21:00:000");

        break;

        case "7":// SI EL DIA ACTUAL ES UN SABADO

$diaconsulta = date('Y-m-d');
$FechaInicioDia=($diaconsulta." 00:00:000");
$FechaFinalDia=($diaconsulta." 23:59:000");

        $domingo=date("Y-m-d",strtotime($fecha_actual."- 7 days")); 
        $fechadomingo8= ($domingo." 08:00:000");
        $fechadomingo9= ($domingo." 09:00:000");
        $fechadomingo10=($domingo." 10:00:000");
        $fechadomingo11=($domingo." 11:00:000");
        $fechadomingo12=($domingo." 12:00:000");
        $fechadomingo13=($domingo." 13:00:000");
        $fechadomingo14=($domingo." 14:00:000");
        $fechadomingo15=($domingo." 15:00:000");
        $fechadomingo16=($domingo." 16:00:000");
        $fechadomingo17=($domingo." 17:00:000");
        $fechadomingo18=($domingo." 18:00:000");
        $fechadomingo19=($domingo." 19:00:000");
        $fechadomingo20=($domingo." 20:00:000");
        $fechadomingo21=($domingo." 21:00:000");

        // Lunes
        
        $lunes=date("Y-m-d",strtotime($fecha_actual."- 6 days"));

        $fechalunes8=   ($lunes." 08:00:000");
        $fechalunes9=   ($lunes." 09:00:000");
        $fechalunes10=  ($lunes." 10:00:000");
        $fechalunes11=  ($lunes." 11:00:000");
        $fechalunes12=  ($lunes." 12:00:000");
        $fechalunes13=  ($lunes." 13:00:000");
        $fechalunes14=  ($lunes." 14:00:000");
        $fechalunes15=  ($lunes." 15:00:000");
        $fechalunes16=  ($lunes." 16:00:000");
        $fechalunes17=  ($lunes." 17:00:000");
        $fechalunes18=  ($lunes." 18:00:000");
        $fechalunes19=  ($lunes." 19:00:000");
        $fechalunes20=  ($lunes." 20:00:000");
        $fechalunes21=  ($lunes." 21:00:000");


        // Martes
        //sumo 1 día
        
        $martes=date("Y-m-d",strtotime($fecha_actual."- 5 days"));
        $fechamartes8=   ($martes." 08:00:000");
        $fechamartes9=   ($martes." 09:00:000");
        $fechamartes10=  ($martes." 10:00:000");
        $fechamartes11=  ($martes." 11:00:000");
        $fechamartes12=  ($martes." 12:00:000");
        $fechamartes13=  ($martes." 13:00:000");
        $fechamartes14=  ($martes." 14:00:000");
        $fechamartes15=  ($martes." 15:00:000");
        $fechamartes16=  ($martes." 16:00:000");
        $fechamartes17=  ($martes." 17:00:000");
        $fechamartes18=  ($martes." 18:00:000");
        $fechamartes19=  ($martes." 19:00:000");
        $fechamartes20=  ($martes." 20:00:000");
        $fechamartes21=  ($martes." 21:00:000");

        // miercoles
        
        $miercoles=date("Y-m-d",strtotime($fecha_actual."- 4 days"));
        $fechamiercoles8=   ($miercoles." 08:00:000");
        $fechamiercoles9=   ($miercoles." 09:00:000");
        $fechamiercoles10=  ($miercoles." 10:00:000");
        $fechamiercoles11=  ($miercoles." 11:00:000");
        $fechamiercoles12=  ($miercoles." 12:00:000");
        $fechamiercoles13=  ($miercoles." 13:00:000");
        $fechamiercoles14=  ($miercoles." 14:00:000");
        $fechamiercoles15=  ($miercoles." 15:00:000");
        $fechamiercoles16=  ($miercoles." 16:00:000");
        $fechamiercoles17=  ($miercoles." 17:00:000");
        $fechamiercoles18=  ($miercoles." 18:00:000");
        $fechamiercoles19=  ($miercoles." 19:00:000");
        $fechamiercoles20=  ($miercoles." 20:00:000");
        $fechamiercoles21=  ($miercoles." 21:00:000");

        // jueves
        $jueves=date("Y-m-d",strtotime($fecha_actual."- 3 days"));
        $fechajueves8=   ($jueves." 08:00:000");
        $fechajueves9=   ($jueves." 09:00:000");
        $fechajueves10=  ($jueves." 10:00:000");
        $fechajueves11=  ($jueves." 11:00:000");
        $fechajueves12=  ($jueves." 12:00:000");
        $fechajueves13=  ($jueves." 13:00:000");
        $fechajueves14=  ($jueves." 14:00:000");
        $fechajueves15=  ($jueves." 15:00:000");
        $fechajueves16=  ($jueves." 16:00:000");
        $fechajueves17=  ($jueves." 17:00:000");
        $fechajueves18=  ($jueves." 18:00:000");
        $fechajueves19=  ($jueves." 19:00:000");
        $fechajueves20=  ($jueves." 20:00:000");
        $fechajueves21=  ($jueves." 21:00:000");

        // viernes
         //sumo 1 día
        $viernes=date("Y-m-d",strtotime($fecha_actual."- 2 days"));
        $fechaviernes8=   ($viernes." 08:00:000");
        $fechaviernes9=   ($viernes." 09:00:000");
        $fechaviernes10=  ($viernes." 10:00:000");
        $fechaviernes11=  ($viernes." 11:00:000");
        $fechaviernes12=  ($viernes." 12:00:000");
        $fechaviernes13=  ($viernes." 13:00:000");
        $fechaviernes14=  ($viernes." 14:00:000");
        $fechaviernes15=  ($viernes." 15:00:000");
        $fechaviernes16=  ($viernes." 16:00:000");
        $fechaviernes17=  ($viernes." 17:00:000");
        $fechaviernes18=  ($viernes." 18:00:000");
        $fechaviernes19=  ($viernes." 19:00:000");
        $fechaviernes20=  ($viernes." 20:00:000");
        $fechaviernes21=  ($viernes." 21:00:000");

        // sabado
         //sumo 1 día
         $hoy=date('Y-m-d');
        $diaconsulta=date("Y-m-d",strtotime($hoy."-1 days"));
        $fechasabado8=   ($diaconsulta." 08:00:000");
        $fechasabado9=   ($diaconsulta." 09:00:000");
        $fechasabado10=  ($diaconsulta." 10:00:000");
        $fechasabado11=  ($diaconsulta." 11:00:000");
        $fechasabado12=  ($diaconsulta." 12:00:000");
        $fechasabado13=  ($diaconsulta." 13:00:000");
        $fechasabado14=  ($diaconsulta." 14:00:000");
        $fechasabado15=  ($diaconsulta." 15:00:000");
        $fechasabado16=  ($diaconsulta." 16:00:000");
        $fechasabado17=  ($diaconsulta." 17:00:000");
        $fechasabado18=  ($diaconsulta." 18:00:000");
        $fechasabado19=  ($diaconsulta." 19:00:000");
        $fechasabado20=  ($diaconsulta." 20:00:000");
        $fechasabado21=  ($diaconsulta." 21:00:000");

        break;

    default:
        //echo "Your favorite color is neither red, blue, nor green!";
}

 ?>