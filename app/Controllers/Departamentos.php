<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DepartamentosModel;

class Departamentos extends BaseController
{
    protected $departamentos;
    public function __construct()
    {
        $this->departamentos = new DepartamentosModel();
    }
    public function index()
    {
        $departamentos = $this->departamentos->obtenerDepartamentos();

        $data = ['titulo' => 'Administrar Departamentos', 'nombre' => 'Darell E', 'datos' => $departamentos];
        echo view('/principal/header', $data);
        echo view('/departamentos/departamentos', $data);
    }
}