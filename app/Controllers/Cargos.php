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
    public function eliminados() //Mostrar vista de Paises Eliminados
    {
        $cargos = $this->cargos->obtenerCargosEliminados();

        if (!$cargos) {
            $data = ['titulo' => 'Administrar Cargos Eliminados', 'nombre' => 'Darell E', 'datos' => 'vacio'];
            echo view('/principal/header', $data);
            echo view('/cargos/eliminados', $data);
        } else {
            $data = ['titulo' => 'Administrar Cargos Eliminados', 'nombre' => 'Darell E', 'datos' => $cargos];
            echo view('/principal/header', $data);
            echo view('/cargos/eliminados', $data);
        }
    }
    public function insertar()
    {
        $tp = $this->request->getPost('tp');

        if ($tp == 1) {

            $this->cargos->save([
                'nombre' => $this->request->getPost('nombre')
            ]);
        } else {
            $this->cargos->update($this->request->getPost('id'), [
                'nombre' => $this->request->getPost('nombre')
            ]);
        }
        return redirect()->to(base_url('/cargos'));
    }
    public function buscar_Cargo($id) //Funcion para buscar un pais en especifico y devolverlo 
    {
        $returnData = array();
        $cargos_ = $this->cargos->traer_Cargo($id);
        if (!empty($cargos_)) {
            array_push($returnData, $cargos_);
        }
        echo json_encode($returnData);
    }
    public function cambiarEstado($id, $estado)
    {
        $cargos_ = $this->cargos->cambiar_Estado($id, $estado);

        if (
            $estado == 'E'
        ) {
            return redirect()->to(base_url('/ver_cargos'));
        } else {
            return redirect()->to(base_url('/eliminados_cargos'));
        }
    }
    public function validar_Campo($campo, $columna, $id_registro)
    {
        $returnData = array();
        $coincidencia = $this->cargos->validar_Campo($campo, $columna);
        $editando = $this->cargos->traer_Cargo($id_registro);
        if ($id_registro == 0) {
            if (!empty($coincidencia)) {
                array_push($returnData, $coincidencia);
            }
        } else {

            if (!empty($coincidencia)) {
                array_push($returnData, $coincidencia, $editando);
            }
        }
        echo json_encode($returnData);
    }
}
