<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SalariosModel;

class Salarios extends BaseController
{
    protected $salarios, $eliminados;
    public function __construct()
    {
        $this->salarios = new SalariosModel();
        $this->eliminados = new SalariosModel();
    }
    public function index()
    {
    }

    public function cambiarEstado()
    {
        $this->salarios->update($this->request->getPost('id_salario'), [
            'estado' => $this->request->getPost('estado')
        ]);
    }


    public function insertar() // Funcion para insertar y actualizar registros
    {
        $tp = $this->request->getPost('tp_salario');
        if ($tp == 1) { //tp 1 = Guardar
            $this->salarios->save([
                'sueldo' => $this->request->getPost('salario_modal'),
                'id_empleado' => $this->request->getPost('id_empleado'),
                'periodo' => $this->request->getPost('periodo_modal')
            ]);
        } else { //tp 2 = actualizar
            $this->salarios->update($this->request->getPost('id_salario'), [
                'sueldo' => $this->request->getPost('salario_modal'),
                'periodo' => $this->request->getPost('periodo_modal')
            ]);
        }
    }
}
