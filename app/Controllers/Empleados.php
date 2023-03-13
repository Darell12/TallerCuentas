<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EmpleadosModel;

class Empleados extends BaseController
{
    protected $empleados;
    public function __construct()
    {
        $this->empleados = new EmpleadosModel();
    }
    public function index()
    {
        $empleados = $this->empleados->obtenerEmpleados();

        $data = ['titulo' => 'Administrar Empleados', 'nombre' => 'Darell E', 'datos' => $empleados];
        echo view('/principal/header', $data);
        echo view('/empleados/empleados', $data);
    }
}