<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuariosModel;


class Usuarios extends BaseController
{
    protected $usuario;


    public function __construct()
    {
        $this->usuario = new UsuariosModel();

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
                $this->usuario->save([
                    'tipo_documento' => $this->request->getPost('tipo_documento'),
                    'n_documento' => $this->request->getPost('n_documento'),
                    'nombre_p' => $this->request->getPost('primer_nombre'),
                    'nombre_s' => $this->request->getPost('segundo_nombre'),
                    'apellido_p' => $this->request->getPost('primer_apellido'),
                    'apellido_s' => $this->request->getPost('segundo_apellido'),
                    'contraseña' => $this->request->getPost('contraseña'),
                    'email' => $this->request->getPost('email'),
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
    public function buscarUsuario($id)
    {
        $returnData = array();
        $usuario = $this->usuario->buscarUsuario($id);
        if (!empty($usuario)) {
            array_push($returnData, $usuario);
        }
        echo json_encode($returnData);
    }

}
