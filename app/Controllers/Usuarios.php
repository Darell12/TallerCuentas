<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuariosModel;


class Usuarios extends BaseController
{
    protected $usuario, $eliminados;


    public function __construct()
    {
        $this->usuario = new UsuariosModel();
        $this->eliminados = new UsuariosModel();
    }
    public function index()
    {
        $usuario = $this->usuario->obtenerUsuarios();

        $data = ['titulo' => 'Administrar Usuarios', 'nombre' => 'Darell E', 'datos' => $usuario];

        echo view('/principal/header', $data);
        echo view('/usuarios/usuarios', $data);
    }
    public function insertar()
    {
        $tp = $this->request->getPost('tp');
        if ($tp == 1) {
            $password = $this->request->getPost('contraseña');
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $this->usuario->save([
                'tipo_documento' => $this->request->getPost('tipo_documento'),
                'n_documento' => $this->request->getPost('n_documento'),
                'nombre_p' => $this->request->getPost('primer_nombre'),
                'nombre_s' => $this->request->getPost('segundo_nombre'),
                'apellido_p' => $this->request->getPost('primer_apellido'),
                'apellido_s' => $this->request->getPost('segundo_apellido'),
                'email' => $this->request->getPost('email'),
                'contraseña' => $hashedPassword,

            ]);
        } else {
            $this->usuario->update($this->request->getPost('id'), [
                'tipo_documento' => $this->request->getPost('tipo_documento'),
                'n_documento' => $this->request->getPost('n_documento'),
                'nombre_p' => $this->request->getPost('primer_nombre'),
                'nombre_s' => $this->request->getPost('segundo_nombre'),
                'apellido_p' => $this->request->getPost('primer_apellido'),
                'apellido_s' => $this->request->getPost('segundo_apellido'),
                'contraseña' => $this->request->getPost('contraseña'),
                'email' => $this->request->getPost('email')
            ]);
        }
        return redirect()->to(base_url('/usuarios'));
    }
    public function eliminados() //Mostrar vista de Paises Eliminados
    {
        $eliminados = $this->eliminados->obtenerUsuariosEliminados();


        // Redireccionar a la URL anterior
        if (!$eliminados) {
            // echo view('/errors/html/no_eliminados');
            $data = ['titulo' => 'Administrar Países Eliminados', 'nombre' => 'Darell E', 'datos' => 'vacio'];
            echo view('/principal/header', $data);
            echo view('/usuarios/eliminados', $data);
        } else {
            $data = ['titulo' => 'Administrar Países Eliminados', 'nombre' => 'Darell E', 'datos' => $eliminados];
            echo view('/principal/header', $data);
            echo view('/usuarios/eliminados', $data);
        }
    }
    public function buscarUsuario($id)
    {
        $returnData = array();
        $usuario = $this->usuario->buscarUsuario($id);
        if (!empty($usuario)) {
            array_push($returnData, $usuario);
        }
        echo json_encode($returnData);
    }
    public function intento($email = 'darellorlandoe@gmail.com')
    {
        $returnData = array();
        $usuario = $this->usuario->login($email);
        if (!empty($usuario)) {
            array_push($returnData, $usuario);
        }
        echo json_encode($returnData);
    }
    public function cambiarEstado($id, $estado)
    {
        $usuario = $this->usuario->cambiar_Estado($id, $estado);

        if (
            $estado == 'E'
        ) {
            return redirect()->to(base_url('/usuarios'));
        } else {
            return redirect()->to(base_url('/usuarios/eliminados'));
        }
    }
    public function login()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getVar('password');

        $usuarioDatos = $this->usuario->login(['email' => $email]);

        if (count($usuarioDatos) > 0 && password_verify($password, $usuarioDatos[0]['contraseña'])) {

            $data = [
                "usuario" => $usuarioDatos[0]['nombre_p'],
                "id" => $usuarioDatos[0]['id_usuario'],
                'logged_in' => true,
            ];

            $session = session();
            $session->set($data);

            echo $session->get('id');
            return redirect()->to(base_url('/principal'))->with('mensaje', '1');
        } else {
            return redirect()->to(base_url('iniciarSesion'))->with('mensaje', '0');
        }
    }
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('iniciarSesion'));
    }
}
