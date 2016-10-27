<?php
class Login extends ActiveRecord\Model
{
    static $connection = 'site';
    
    public function valida_acceso($log_usu , $pas_usu)
    {
        $sql = "SELECT id FROM usuarios WHERE log_usu = '$log_usu' AND pas_usu = '$pas_usu'";
        $respuesta = Login::find_by_sql($sql);
        if(count($respuesta) > 0)
        {
            return (object)$respuesta[0]->attributes();
        }
        else
        {
            return count($respuesta);
        }
        
    }
    
    public function cambiar_contrasena($data)
    {
        $usuario = Usuarios::find(Session::get("id_usu"));        
        if(md5($data->pas_act) != $usuario->pas_usu)
        {
            return -1;
        }
        
        if($data->pas_nue != $data->pas_con)
        {
            return -2;
        }
        
        $atributos = Array("pas_usu"=>  md5($data->pas_nue));
        $usuario->update_attributes($atributos);
        return 1;        
    }
    
    public function restablecer_contrasena($data)
    {        
        if(!$usuario = Usuarios::find_by_log_usu($data->log_usu))
        {            
            return -1;//usuario no existe
        }
        else
        {
            $possible_letters = '23456789bcdfghjkmnpqrstvwxyz';
            $code = '';
            $i = 0;
            while ($i < 8) 
            { 
                $code .= substr($possible_letters, mt_rand(0, strlen($possible_letters)-1), 1);
                $i++;
            }
            
            //include_once 'clases/PHPMailer_v5.1/class.phpmailer.php';
            // multiple recipients
            $to = $usuario->ema_usu;
            // subject		
            $subject = APP_SUBNOMBRE;

            // message
            $message = "
                    <html>
                    <head>
                    <title>Recuperar Contraseña</title>
                    </head>
                    <body>

                    Estimado(a) ".  ucfirst($usuario->nom_usu)." ".ucfirst($usuario->ape_usu)."<br />
            
                                                        
                        <h3>La Recuperación de contraseña se realizó satisfactoriamente.</h3>
                    <p>
                        ".APP_SUBNOMBRE." le informa que su contraseña para acceder a nuestro sistema es: <b>$code</b>
                    </p>
                    <p>
                        <b>
                        IMPORTANTE: Le recordamos que para ingresar de manera exitosa y segura en el sistema de ".APP_SUBNOMBRE." debe 
                        realizar el cambio de contraseña por una de su conveniencia.
                        </b>
                    </p>

                    <b>".APP_SUBNOMBRE."</b>

                    </body>
                    </html>";
            
            //utf8_encode($message);
            // To send HTML mail, the Content-type header must be set
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
            $headers .= "From: noreply@igvsb.gob.ve" . "\r\n";
            
            $mail = new PHPMailer();
            $mail->SMTPDebug = 1;
            $mail->IsSMTP();
            $mail->CharSet = "UTF-8";
            $mail->SMTPAuth = true;
            $mail->Mailer = "smtp";
            $mail->SMTPSecure = "tls";
            $mail->Host = 'mail.igvsb.gob.ve';
            $mail->Port = 25;
            $mail->Username = "noreply";
            $mail->Password = "*N0-r3pLy/"; // Password 
            $mail->IsHTML(true);
            $mail->From = "noreply@igvsb.gob.ve";
            $mail->FromName = APP_SUBNOMBRE;   //Texto personalizado 

            $body = $message;
            $mail->Subject = $subject;

            $mail->MsgHTML($body);
            $mail->AddAddress($to);
            //$mail->Send();
            if (!$mail->Send()) 
            {
                return -2;               
                //echo "Mailer Error: " . $mail->ErrorInfo;
                //echo "No enviado";
            }
            else
            {
                //mail($to, $subject, $message, $headers);
                $usuario->update_attributes(Array('pas_usu' => md5($code)));
                return 1;
            }            
        }                
    }
}
?>
