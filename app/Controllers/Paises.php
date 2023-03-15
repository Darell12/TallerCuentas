<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PaisesModel;

class Paises extends BaseController
{
    protected $pais;
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

    public function eliminados()
    {
        $eliminados = $this->eliminados->obtenerPaisesEliminados();

        if (!$eliminados) {
           echo view('/errors/html/no_eliminados');
        } else {
        $data = ['titulo' => 'Administrar Paises', 'nombre' => 'Darell E', 'datos' => $eliminados];
        echo view('/principal/header', $data);
        echo view('/paises/eliminados', $data);
        }
        


    }
    public function cambiarEstado($id)
    {
        $registro = $this->pais->find($id); // Buscar registro a actualizar
    
        if (!$registro) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('No se encontró el registro solicitado.');
        }
    
        // Cambiar valor del campo "estado"
        $estado_actual = $registro['estado'];
        
    
        $datos_actualizados = [
            'estado' => 'I'
        ];
    
        $this->pais->update($id, $datos_actualizados); // Actualizar registro
    
        return redirect()->to(base_url('/paises'));
    }
    public function Restaurar($id)
    {
        $eliminados = $this->eliminados->obtenerPaisesEliminados();
        $registro = $this->pais->find($id); // Buscar registro a actualizar
    
        if (!$registro) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('No se encontró el registro solicitado.');
        }
    
        // Cambiar valor del campo "estado"
        $estado_actual = $registro['estado'];
        
    
        $datos_actualizados = [
            'estado' => 'A'
        ];
    
        $this->pais->update($id, $datos_actualizados); // Actualizar registro
        
        if(!$eliminados){
           return redirect()->to(base_url('/paises/eliminados'));
        }else{
            return redirect()->to(base_url('/paises'));
        }
        
    }
    public function buscar_Pais($id)
    {
        $returnData = array();
        $pais_ = $this->pais->traer_Pais($id);
        if (!empty($pais_)) {
            array_push($returnData, $pais_);
        }
        echo json_encode($returnData);
    }
    public function insertar()
    {
        $tp=$this->request->getPost('tp');
        if ($this->request->getMethod() == "post") {
            if ($tp == 1) {
                $this->pais->save([
                    'codigo' => $this->request->getPost('codigo'),
                    'nombre' => $this->request->getPost('nombre')
                ]);
            } else {
                $this->pais->update($this->request->getPost('id'),[                    
                    'nombre' => $this->request->getPost('nombre'),
                    'codigo' => $this->request->getPost('codigo')
                ]);
            }
            return redirect()->to(base_url('/paises'));
        }
    }
}