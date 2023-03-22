<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DepartamentosModel;
use App\Models\PaisesModel;

class Departamentos extends BaseController
{
    protected $departamentos, $eliminados, $paises;

    public function __construct()
    {
        $this->departamentos = new DepartamentosModel();
        $this->paises = new PaisesModel();
        $this->eliminados = new DepartamentosModel();
    }
    public function index()
    {
        $departamentos = $this->departamentos->obtenerDepartamentos();
        $paises = $this->paises->obtenerPaises();

        $data = ['titulo' => 'Administrar Departamentos', 'nombre' => 'Darell E', 'datos' => $departamentos, 'paises' => $paises];
        echo view('/principal/header', $data);
        echo view('/departamentos/departamentos', $data);
    }
    public function eliminados() //Mostrar vista de Paises Eliminados
    {
        $eliminados = $this->eliminados->obtenerDptosEliminados();

        if (!$eliminados) {
            echo view('/errors/html/no_eliminados');
        } else {
            $data = ['titulo' => 'Administrar Dptos Eliminados', 'nombre' => 'Darell E', 'datos' => $eliminados];
            echo view('/principal/header', $data);
            echo view('/departamentos/eliminados', $data);
        }
    }

    public function insertar() // Funcion para insertar y actualizar registros
    {
        $tp = $this->request->getPost('tp');

            if ($tp == 1) { //tp 1 = Guardar
                $this->departamentos->save([
                    'id_pais' => $this->request->getPost('pais'),
                    'nombre' => $this->request->getPost('nombre')
                ]);
            } else { //tp 2 = actualizar
                $this->departamentos->update($this->request->getPost('id'), [
                    'id_pais' => $this->request->getPost('pais'),
                    'nombre' => $this->request->getPost('nombre')
                ]);
            }
            return redirect()->to(base_url('/departamentos'));
    }
    public function buscar_Dpto($id) //Funcion para buscar un pais en especifico y devolverlo 
    {
        $returnData = array();
        $departamentos_ = $this->departamentos->traer_Dpto($id);
        if (!empty($departamentos_)) {
            array_push($returnData, $departamentos_);
        }
        echo json_encode($returnData);
    }
    public function cambiarEstado($id, $estado)
    {
        $departamentos_ = $this->departamentos->cambiar_Estado($id, $estado);

        if (
            $estado == 'E'
        ) {
            return redirect()->to(base_url('/departamentos'));
        } else {
            return redirect()->to(base_url('/departamentos/eliminados'));
        }
    }
    public function validar_Nombre($nombre) 
    {
        $returnData = array();
        $departamentos = $this->departamentos->validar_Nombre($nombre);
        if (!empty($departamentos)) {
            array_push($returnData, $departamentos);
        }
        echo json_encode($returnData);   
    }
}
