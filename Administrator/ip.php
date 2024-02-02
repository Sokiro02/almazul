<?php 

# codigo que intenta mostrar la IP local, IP pública, la IP del proxy y el hostname de la IP pública 

if($_SERVER["HTTP_X_FORWARDED_FOR"]) 
{ 
    if($pos=strpos($_SERVER["HTTP_X_FORWARDED_FOR"]," ")) 
    { 
        echo "IP local: ".substr($_SERVER["HTTP_X_FORWARDED_FOR"],0,$pos)." <br>- IP Pública: ".substr($_SERVER["HTTP_X_FORWARDED_FOR"],$pos+1); 
        $hostlocal=substr($_SERVER["HTTP_X_FORWARDED_FOR"],$pos+1); 
    }else{ 
        echo "<br>&ippublica=".$_SERVER["HTTP_X_FORWARDED_FOR"]; 
        $hostlocal=$_SERVER["HTTP_X_FORWARDED_FOR"]; 
    } 
    if($_SERVER["REMOTE_ADDR"]) 
        echo "<br> - Proxy: ".$_SERVER["REMOTE_ADDR"]; 
}else{ 
    echo "<br>&ippublica=".$_SERVER["REMOTE_ADDR"]; 
    $hostlocal=$_SERVER["REMOTE_ADDR"]; 
    if($hostlocal!=$_SERVER["REMOTE_ADDR"]) 
        echo " <br>- Hostname: ".$hostlocal; 
} 
$hostname = gethostbyaddr ($_SERVER['REMOTE_ADDR']); 
if($hostlocal!=$hostname) 
    echo "<br>&hostname=".$hostname; 

   if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) { $ip = $_SERVER['HTTP_X_FORWARDED_FOR']; }   
   elseif (isset($_SERVER['HTTP_VIA'])) { $ip = $_SERVER['HTTP_VIA']; }   
   elseif (isset($_SERVER['REMOTE_ADDR'])) { $ip = $_SERVER['REMOTE_ADDR']; } 
   else { $ip = "Desconocido"; } 
   echo "<br>&ip=" . $ip . "&dns=".$_SERVER['HTTP_USER_AGENT']."<br>"; 
$hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
echo $hostname;
?>
  
