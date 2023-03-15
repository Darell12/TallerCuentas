<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MunicipiosModel;
use App\Models\PaisesModel;

class Municipios extends BaseController
{
    protected $municipios;
    protected $pais;
    public function __construct()
    {
        $this->municipios = new MunicipiosModel();
        $this->pais = new PaisesModel();
    }
    public function index()
    {
        $municipios = $this->municipios->obtenerMunicipios();
        $pais = $this->pais->obtenerPaises();

        $data = ['titulo' => 'Administrar Municipios', 'nombre' => 'Darell E', 'datos' => $municipios, 'paises' => $pais];
        echo view('/principal/header', $data);
        echo view('/municipios/municipios', $data);
    }
}