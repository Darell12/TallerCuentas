<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MunicipiosModel;

class Municipios extends BaseController
{
    protected $municipios;
    public function __construct()
    {
        $this->municipios = new MunicipiosModel();
    }
    public function index()
    {
        $municipios = $this->municipios->obtenerMunicipios();

        $data = ['titulo' => 'Administrar Paises', 'nombre' => 'Darell E', 'datos' => $municipios];
        echo view('/principal/header', $data);
        echo view('/municipios/municipios', $data);
    }
}