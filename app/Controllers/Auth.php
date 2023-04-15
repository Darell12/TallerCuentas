<?php

use App\Controllers\BaseController;
use App\Models\UsuariosModel;

class Auth extends BaseController
{
    protected $usuario;

    public function __construct()
    {
        $this->usuario = new UsuariosModel;
    }

    public function login()
    {
        $data = [];

        if ($this->request->getMethod() == 'post') {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $model = new UsuariosModel();
            $user = $model->where('email', $email)->first();

            if ($user) {
                if (password_verify($password, $user['contraseña'])) {
                    $session = session();
                    $session->set([
                        'user_id' => $user['id_usuario'],
                        'user_name' => $user['nombre_p'],
                        'logged_in' => true
                    ]);

                    return redirect()->to('/');
                }
            }

            $data['error'] = 'El correo electrónico o la contraseña son incorrectos';
        }

        echo view('principal/login', $data);
    }

    public function logout()
    {
        $session = session();
        $session->destroy();

        return redirect()->to('/');
    }
}
