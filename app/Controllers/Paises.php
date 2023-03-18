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

        $data = ['titulo' => 'Administrar Paises', 'nombre' => 'Darell E', 'datos' => $pais];
        echo view('/principal/header', $data);
        echo view('/paises/paises', $data);
    }

    public function eliminados() //Mostrar vista de Paises Eliminados
    {
        $eliminados = $this->eliminados->obtenerPaisesEliminados();

        if (!$eliminados) {
            echo view('/errors/html/no_eliminados');
        } else {
            $data = ['titulo' => 'Administrar Paises Eliminados', 'nombre' => 'Darell E', 'datos' => $eliminados];
            echo view('/principal/header', $data);
            echo view('/paises/eliminados', $data);
        }
    }

    public function cambiarEstado() //Eliminaer el pais cambiando el estado = Borrado Logico
    {
        $this->pais->update($this->request->getPost('id'), [
            'estado' => $this->request->getPost('estado')
        ]);

        return redirect()->to(base_url('/paises'));
    }

    public function Restaurar() //Restaurar pais cambiando el estado
    {
        $this->pais->update($this->request->getPost('id'), [
            'estado' => $this->request->getPost('estado')
        ]);

        return redirect()->to(base_url('/paises/eliminados'));
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
            return redirect()->to(base_url('/paises'));
        }
    }
}
