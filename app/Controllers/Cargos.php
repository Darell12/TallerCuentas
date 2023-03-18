<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CargosModel;

class Cargos extends BaseController
{
    protected $cargos;
    public function __construct()
    {
        $this->cargos = new CargosModel();
    }
    public function index()
    {
        $cargos = $this->cargos->obtenerCargos();

        $data = ['titulo' => 'Administrar Cargos', 'nombre' => 'Darell E', 'datos' => $cargos];
        echo view('/principal/header', $data);
        echo view('/cargos/cargos', $data);
    }
    public function insertar()
    {
        if ($this->request->getMethod() == "post") {

            $this->cargos->save([
                'nombre' => $this->request->getPost('nombre')
            ]);
            return redirect()->to(base_url('/cargos'));
        }
    }
}
