<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DepartamentosModel;
use App\Models\PaisesModel;

class Departamentos extends BaseController
{
    protected $departamentos;
    protected $paises;
    public function __construct()
    {
        $this->departamentos = new DepartamentosModel();
        $this->paises = new PaisesModel();
    }
    public function index()
    {
        $departamentos = $this->departamentos->obtenerDepartamentos();
        $paises = $this->paises->obtenerPaises();

        $data = ['titulo' => 'Administrar Departamentos', 'nombre' => 'Darell E', 'datos' => $departamentos, 'paises' => $paises];
        echo view('/principal/header', $data);
        echo view('/departamentos/departamentos', $data);
    }
    public function insertar()
    {
        if ($this->request->getMethod() == "post" ) {
            
            $this->departamentos->save([    
                'id_pais' => $this->request->getPost('pais'),          
                'nombre' => $this->request->getPost('nombre')
            ]);
            return redirect()->to(base_url('/departamentos'));
        } 
    }

}