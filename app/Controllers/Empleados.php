<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\EmpleadosModel;
use App\Models\CargosModel;
use App\Models\MunicipiosModel;
use App\Models\SalariosModel;
use App\Models\PaisesModel;
use App\Models\DepartamentosModel;

class Empleados extends BaseController
{
    protected $empleados;
    protected $municipios;
    protected $cargos;
    protected $salarios;
    protected $pais;
    protected $departamentos;

    public function __construct()
    {
        $this->empleados = new EmpleadosModel();
        $this->municipios = new MunicipiosModel();
        $this->cargos = new CargosModel();
        $this->salarios = new SalariosModel();
        $this->pais = new PaisesModel();
        $this->departamentos = new DepartamentosModel();
    }
    public function index()
    {
        $empleados = $this->empleados->obtenerEmpleados();
        $municipios = $this->municipios->obtenerMunicipios();
        $cargos = $this->cargos->obtenerCargos();
        $pais = $this->pais->obtenerPaises();

        $data = ['titulo' => 'Administrar Empleados', 'nombre' => 'Darell E', 'datos' => $empleados, 'municipios' => $municipios, 'cargos' => $cargos, 'paises' => $pais];

        echo view('/principal/header', $data);
        echo view('/empleados/empleados', $data);
    }
    public function eliminados() //Mostrar vista de Paises Eliminados
    {
        $empleados = $this->empleados->obtenerEmpleadosEliminados();

        if (!$empleados) {
            echo view('/errors/html/no_eliminados');
        } else {
            $data = ['titulo' => 'Empleados Eliminados', 'nombre' => 'Darell E', 'datos' => $empleados];
            echo view('/principal/header', $data);
            echo view('/empleados/eliminados', $data);
        }
    }
    public function buscar_Emp($id) //Funcion para buscar un pais en especifico y devolverlo 
    {
        $returnData = array();
        $empleados_ = $this->empleados->traer_Emp($id);
        if (!empty($empleados_)) {
            array_push($returnData, $empleados_);
        }
        echo json_encode($returnData);
    }
    public function insertar()
    {
        $tp = $this->request->getPost('tp');
        if ($this->request->getMethod() == "post") {
            if ($tp == 1) {
                $this->empleados->save([
                    'nombres' => $this->request->getPost('nombres'),
                    'apellidos' => $this->request->getPost('apellidos'),
                    'nacimiento' => $this->request->getPost('nacimiento'),
                    'id_municipio' => $this->request->getPost('municipio'),
                    'id_cargo' => $this->request->getPost('cargo')
                ]);

                $id = $this->empleados->obtenerUltimo();

                $this->salarios->save([
                    'id_empleado' => $id,
                    'sueldo' => $this->request->getPost('salario'),
                    'periodo' => $this->request->getPost('periodo')
                ]);
            } else {
                $this->empleados->update($this->request->getPost('id'), [
                    'nombres' => $this->request->getPost('nombres'),
                    'apellidos' => $this->request->getPost('apellidos'),
                    'nacimiento' => $this->request->getPost('nacimiento'),
                    'id_municipio' => $this->request->getPost('municipio'),
                    'id_cargo' => $this->request->getPost('cargo')
                ]);

                $id = $this->empleados->obtenerUltimo();

                $this->salarios->update($this->request->getPost('salario_id'), [
                    'sueldo' => $this->request->getPost('salario'),
                    'periodo' => $this->request->getPost('periodo')
                ]);
            }
            return redirect()->to(base_url('/empleados'));
        }
    }
    public function traer($id)
    {
        $returnData = array();
        $salarios_ = $this->salarios->traer($id);
        if (!empty($salarios_)) {
            array_push($returnData, $salarios_);
        }
        echo json_encode($returnData);
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
    public function cambiarEstado($id, $estado)
    {
        $empleados_ = $this->empleados->elimina_Emp($id, $estado);

        if ($estado == 'E') {
            return redirect()->to(base_url('/empleados'));
        } else {
            return redirect()->to(base_url('/empleados/eliminados')); 
        }
        
    }
}
