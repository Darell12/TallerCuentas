<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EmpleadosModel;
use App\Models\CargosModel;
use App\Models\MunicipiosModel;

class Empleados extends BaseController
{
    protected $empleados;
    protected $municipios;
    protected $cargos;

    public function __construct()
    {
        $this->empleados = new EmpleadosModel();
        $this->municipios = new MunicipiosModel();
        $this->cargos = new CargosModel();
    }
    public function index()
    {
        $empleados = $this->empleados->obtenerEmpleados();
        $municipios = $this->municipios->obtenerMunicipios();
        $cargos = $this->cargos->obtenerCargos();

        $data = ['titulo' => 'Administrar Empleados', 'nombre' => 'Darell E', 'datos' => $empleados, 'municipios' => $municipios, 'cargos' => $cargos];
        echo view('/principal/header', $data);
        echo view('/empleados/empleados', $data);
    }
    public function insertar()
    {
        if ($this->request->getMethod() == "post" ) {
            
            $this->empleados->save([              
                'nombres' => $this->request->getPost('nombres'),
                'apellidos' => $this->request->getPost('apellidos'),
                'nacimiento' => $this->request->getPost('nacimiento'),
                'id_municipio' => $this->request->getPost('municipio'),
                'id_cargo' => $this->request->getPost('cargo')

            ]);
            return redirect()->to(base_url('/empleados'));
        } 
    }
}