<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PaisesModel;

class Paises extends BaseController
{
    protected $pais, $eliminados;
    public function __construct()
    {
        $this->pais = new PaisesModel();
        $this->eliminados = new PaisesModel();
    }
    public function index()
    {
        $pais = $this->pais->obtenerPaises();

        $data = ['titulo' => 'Administrar Países', 'nombre' => 'Darell E', 'datos' => $pais];
        echo view('/principal/header', $data);
        echo view('/paises/paises', $data);
    }

    public function eliminados() //Mostrar vista de Paises Eliminados
    {
        $eliminados = $this->eliminados->obtenerPaisesEliminados();
       

        // Redireccionar a la URL anterior
        if (!$eliminados) {
            // echo view('/errors/html/no_eliminados');
            $data = ['titulo' => 'Administrar Países Eliminados', 'nombre' => 'Darell E', 'datos' => 'vacio'];
            echo view('/principal/header', $data);
            echo view('/paises/eliminados', $data);
        } else {
            $data = ['titulo' => 'Administrar Países Eliminados', 'nombre' => 'Darell E', 'datos' => $eliminados];
            echo view('/principal/header', $data);
            echo view('/paises/eliminados', $data);
        }
    }

    public function cambiarEstado($id, $estado)
    {
        $pais_ = $this->pais->cambiar_Estado($id, $estado);

        if (
            $estado == 'E'
        ) {
            return redirect()->to(base_url('/ver_paises'));
        } else {
            return redirect()->to(base_url('/eliminados_paises'));
        }
    }

    public function buscar_Pais($id) //Funcion para buscar un pais en especifico y devolverlo 
    {
        $returnData = array();
        $pais_ = $this->pais->traer_Pais($id);
        if (!empty($pais_)) {
            array_push($returnData, $pais_);
        }
        echo json_encode($returnData);
    }

    public function insertar() // Funcion para insertar y actualizar registros
    {
        $tp = $this->request->getPost('tp');
        if ($this->request->getMethod() == "post") {
            if ($tp == 1) { //tp 1 = Guardar
                $this->pais->save([
                    'codigo' => $this->request->getPost('codigo'),
                    'nombre' => $this->request->getPost('nombre')
                ]);
            } else { //tp 2 = actualizar
                $this->pais->update($this->request->getPost('id'), [
                    'nombre' => $this->request->getPost('nombre'),
                    'codigo' => $this->request->getPost('codigo')
                ]);
            }
            return redirect()->to(base_url('/ver_paises'));
        }
    }
    public function validar_Campo($campo, $columna, $id_registro) 
    {
        $returnData = array();
        $coincidencia = $this->pais->validar_Campo($campo, $columna);
        $editando = $this->pais->traer_Pais($id_registro);

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
    public function validar_CampoP() 
    {
        $returnData = array();
        $coincidencia = $this->pais->validar_Campo('nombre', 'nombre');
        $editando = $this->pais->traer_Pais('id');

        if ('id' == 0) {
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
