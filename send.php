<?php

/***librerias phpmailer**/
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/* Exception class. */
require 'PHPMailer/src/Exception.php';

/* The main PHPMailer class. */
require 'PHPMailer/src/PHPMailer.php';

/* SMTP class, needed if you want to use SMTP. */
require 'PHPMailer/src/SMTP.php';
/**********/

$imagen = $_POST["imagen"];
$horiz3_regGP = $_POST["horiz3_regGP"];
$horiz3_regCA = $_POST["horiz3_regCA"];
$horiz3_regND = $_POST["horiz3_regND"];
$horiz3_regCD = $_POST["horiz3_regCD"];
$horiz3_regNA = $_POST["horiz3_regNA"];
/*
echo $imagen;
echo "<br>";
echo $horiz3_regGP;
echo "<br>";
echo $horiz3_regCA;
echo "<br>";
echo $horiz3_regND;
echo "<br>";
echo $horiz3_regCD;
echo "<br>";
echo $horiz3_regNA;
echo "<br>";
//die("fin");
**/
$imagen = preg_replace('#^data:image/[^;]+;base64,#', '', $imagen); 
$mensaje = '<b>Horizontes 3</b><br><b>Nombre del estudiante: </b>'.$horiz3_regNA.'<br><b>Grupo: </b> '.$horiz3_regGP.'<br><b>Docente: </b>'.$horiz3_regND;

$para = $horiz3_regCD;
$para2 = $horiz3_regCA;
$asunto = 'Horizontes 3: Actividad';				
//Create a new PHPMailer instance
$mail = new PHPMailer();
$mail->IsSMTP();
//Agregar la imagen
$decode = base64_decode($imagen);
$mail->addStringAttachment($decode, "Actividad.png", "base64", "image/png");
$mensaje .= '<br><img src="https://majesticeducacion.com.mx/nuevo/wp-content/uploads/2018/08/logo-header-majesticeducacion.png">';
 
//Configuracion servidor mail

$mail->From = "ebook@majesticeducationdigital.com"; //remitente
$mail->FromName = "Majestic Education";//nombre remitente
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl'; //seguridad
$mail->Host = "mail.majesticeducationdigital.com"; // servidor smtp
$mail->Port = 465; //puerto
$mail->Username ='ebook@majesticeducationdigital.com'; //nombre usuario
$mail->Password = '[;$&0?H_zuq#'; //contraseña


 
//Agregar destinatario
$mail->AddAddress($para);
$mail->AddAddress($para2);
$mail->Subject = $asunto;
$mail->IsHTML(true);
$mail->Body = $mensaje;


 
//Avisar si fue enviado o no y dirigir al index
if ($mail->Send()) {
    echo'<script type="text/javascript">
           alert("Enviado correctamente");
		   window.history.back();
        </script>';
} else {
    echo'<script type="text/javascript">
           alert("No enviado, intenta de nuevo");
        </script>';
}
?>