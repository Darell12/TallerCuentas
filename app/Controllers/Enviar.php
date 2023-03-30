<?php

namespace App\Controllers;

use CodeIgniter\Email\Email;

class Enviar extends BaseController
{
    protected $email;

    public function sendEmail()
    {
        $email = new Email();

        $email->setFrom('darellorlandoe@gmail.com', 'Darell');
        $email->setTo('ccp93071@gmail.com');
        $email->setSubject('Asunto de Prueba');
        $email->setMessage('Hola contenido de prueba');
        
        if ($email->send()) {
            echo 'Enviado con exito';
        } else {
            $error = $email->printDebugger();
            echo $error;
        }
    }
}
