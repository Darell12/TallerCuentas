<?php

namespace App\Models; //Reservamos el espacio de nombre de la ruta app\models

use CodeIgniter\Model;

class EmpleadosModel extends Model
{
    protected $table = 'empleados'; /* nombre de la tabla modelada/*/
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true; /* Si la llave primaria se genera con autoincremento*/

    protected $returnType = 'array'; /* forma en que se retornan los datos */
    protected $useSoftDeletes = false; /* si hay eliminacion fisica de registro */

    protected $allowedFields = ['nombres', 'apellidos', 'id_municipio', 'nacimiento', 'id_cargo', 'estado', 'fecha_crea']; /* relacion de campos de la tabla */

    protected $useTimestamps = true; /*tipo de tiempo a utilizar */
    protected $createdField = 'fecha_crea'; /*fecha automatica para la creacion */
    protected $updatedField = ''; /*fecha automatica para la edicion */
    protected $deletedField = ''; /*no se usara, es para la eliminacion fisica */

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    public function obtenerEmpleados()
    {
        $this->select('empleados.*, municipios.nombre as NMuni, cargos.nombre as NCargo, salarios.sueldo as salario');
        $this->join('municipios', 'municipios.id = empleados.id_municipio');
        $this->join('cargos', 'cargos.id = empleados.id_cargo');
        $this->join('salarios', 'salarios.id_empleado = empleados.id', 'left');
        $this->where('empleados.estado', 'A');
        // $this->orderBy('id'); // ordena por el nombre de los empleados en orden alfabético ascendente
        $datos = $this->findAll();
        return $datos;
    }
    public function obtenerEmpleadoId($id)
    {
        $this->select('empleados.*');
        $this->where('id', $id);
        $datos = $this->first();
        return $datos;
    }
    public function obtenerUltimo()
    {
        $id = $this->getInsertID();
        return $id;
    }
    public function traer_Emp($id)
    {
        $this->select('empleados.*, municipios.nombre as NMuni, cargos.nombre as NCargo, salarios.sueldo as salario, salarios.periodo as periodo, salarios.id as salario_id');
        $this->join('municipios', 'municipios.id = empleados.id_municipio');
        $this->join('cargos', 'cargos.id = empleados.id_cargo');
        $this->join('salarios', 'salarios.id_empleado = empleados.id', 'left');
        $this->where('empleados.id', $id);
        $datos = $this->first();  // nos trae el registro que cumpla con una condicion dada 
        return $datos;
    }
}
