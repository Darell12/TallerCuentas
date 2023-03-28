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
    public function eliminados() //Mostrar vista de Paises Eliminados
    {
        $cargos = $this->municipios->obtenerMunicipiosEliminados();

        if (!$cargos) {
            $data = ['titulo' => 'Administrar Municipios Eliminados', 'nombre' => 'Darell E', 'datos' => 'vacio'];
            echo view('/principal/header', $data);
            echo view('/municipios/eliminados', $data);
        } else {
            $data = ['titulo' => 'Administrar Municipios Eliminados', 'nombre' => 'Darell E', 'datos' => $cargos];
            echo view('/principal/header', $data);
            echo view('/municipios/eliminados', $data);
        }
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
        $tp = $this->request->getPost('tp');
        if ($tp == 1) {
            $this->municipios->save([
                'id_dpto' => $this->request->getPost('departamento'),
                'nombre' => $this->request->getPost('nombre')
            ]);
        } else { //tp 2 = actualizar
            $this->municipios->update($this->request->getPost('id'), [
                'id_dpto' => $this->request->getPost('departamento'),
                'nombre' => $this->request->getPost('nombre')
            ]);
        }
        return redirect()->to(base_url('/ver_munis'));
    }
    public function obtenerMuniDpto($id)
    {
        $dataArray = array();
        $municipios = $this->municipios->obtenerMuniDpto($id);
        if (!empty($municipios)) {
            array_push($dataArray, $municipios);
        }
        echo json_encode($municipios);
    }
    public function buscar_Muni($id) //Funcion para buscar un pais en especifico y devolverlo 
    {
        $returnData = array();
        $municipios_ = $this->municipios->traer_Muni($id);
        if (!empty($municipios_)) {
            array_push($returnData, $municipios_);
        }
        echo json_encode($returnData);
    }
    public function cambiarEstado($id, $estado)
    {
        $municipios_ = $this->municipios->cambiar_Estado($id, $estado);

        if (
            $estado == 'E'
        ) {
            return redirect()->to(base_url('/ver_munis'));
        } else {
            return redirect()->to(base_url('/eliminados_municipios'));
        }
    }
    public function validar_Campo($campo, $columna, $id_registro) 
    {
        $returnData = array();
        $coincidencia = $this->municipios->validar_Campo($campo, $columna);
        $editando = $this->municipios->traer_Muni($id_registro);

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
