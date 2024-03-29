<?php

namespace App\Models; //Reservamos el espacio de nombre de la ruta app\models

use CodeIgniter\Model;

class SalariosModel extends Model
{
    protected $table = 'salarios'; /* nombre de la tabla modelada/*/
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true; /* Si la llave primaria se genera con autoincremento*/

    protected $returnType = 'array'; /* forma en que se retornan los datos */
    protected $useSoftDeletes = false; /* si hay eliminacion fisica de registro */

    protected $allowedFields = ['sueldo', 'periodo', 'id_empleado', 'estado', 'fecha_crea']; /* relacion de campos de la tabla */

    protected $useTimestamps = true; /*tipo de tiempo a utilizar */
    protected $createdField = 'fecha_crea'; /*fecha automatica para la creacion */
    protected $updatedField = ''; /*fecha automatica para la edicion */
    protected $deletedField = ''; /*no se usara, es para la eliminacion fisica */

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    public function traer($id)
    {
        $this->select('salarios.*');
        $this->where('salarios.id_empleado', $id);
        $this->where('salarios.estado', 'A');
        $datos = $this->first();  // nos trae el registro que cumpla con una condicion dada 
        return $datos;
    }
    public function salario_empleado($id)
    {
        $this->select('salarios.*, empleados.nombres as nombre_empleado');
        $this->join('empleados', 'salarios.id_empleado = empleados.id');
        $this->where('salarios.id_empleado', $id);
        $this->where('salarios.estado', 'A');
        $datos = $this->findAll();  // nos trae el registro que cumpla con una condicion dada 
        return $datos;
    }
    public function salario_empleado_eliminado($id)
    {
        $this->select('salarios.*, empleados.nombres as nombre_empleado');
        $this->join('empleados', 'salarios.id_empleado = empleados.id');
        $this->where('salarios.id_empleado', $id);
        $this->where('salarios.estado', 'E');
        $datos = $this->findAll();  // nos trae el registro que cumpla con una condicion dada 
        return $datos;
    }
    public function salario_id($id)
    {
        $this->select('salarios.*, empleados.nombres as nombre_empleado');
        $this->join('empleados', 'salarios.id_empleado = empleados.id');
        $this->where('salarios.id', $id);
        $this->where('salarios.estado', 'A');
        $datos = $this->first();  // nos trae el registro que cumpla con una condicion dada 
        return $datos;
    }
    public function cambiar_Estado($id, $estado)
    {
        $datos = $this->update($id, ['estado' => $estado]);
        return $datos;
    }
}
