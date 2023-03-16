<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MunicipiosModel;
use App\Models\PaisesModel;
use App\Models\DepartamentosModel;

class Municipios extends BaseController
{
    protected $municipios;
    protected $pais;
    protected $departamentos;
    public function __construct()
    {
        $this->municipios = new MunicipiosModel();
        $this->pais = new PaisesModel();
        $this->departamentos = new DepartamentosModel();

    }
    public function index()
    {
        $municipios = $this->municipios->obtenerMunicipios();
        $pais = $this->pais->obtenerPaises();

        $data = ['titulo' => 'Administrar Municipios', 'nombre' => 'Darell E', 'datos' => $municipios, 'paises' => $pais];
        echo view('/principal/header', $data);
        echo view('/municipios/municipios', $data);
    }
    public function obtenerDepartamentosPais($id) 
    {
        $dataArray = array();
        $departamentos = $this->departamentos->obtenerDepartamentosPais($id);
        if (!empty($departamentos)) {
            array_push($dataArray, $departamentos);
        }
        echo json_encode($departamentos);
    }
    public function insertar()
    {
        if ($this->request->getMethod() == "post" ) {
            
            $this->municipios->save([    
                'id_dpto' => $this->request->getPost('departamento'),          
                'nombre' => $this->request->getPost('nombre')
            ]);
            return redirect()->to(base_url('/municipios'));
        } 
    }
}