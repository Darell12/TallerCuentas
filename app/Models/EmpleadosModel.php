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
        $this->select('empleados.*, municipios.nombre as NMuni, municipios.estado as estadoMuni, cargos.nombre as NCargo, cargos.estado as estadoCargo, departamentos.nombre as dpto_nombre, departamentos.estado as estadoDpto, paises.nombre as pais_nombre, paises.estado as estadoPais');
        $this->join('municipios', 'municipios.id = empleados.id_municipio');
        $this->join('departamentos', 'municipios.id_dpto = departamentos.id');
        $this->join('paises', 'departamentos.id_pais = paises.id');
        $this->join('cargos', 'cargos.id = empleados.id_cargo');
        // $this->join('salarios', 'salarios.id_empleado = empleados.id', 'left');
        $this->where('empleados.estado', 'A');
        $this->orderBy('nombres', 'ASC'); // ordena por el nombre de los empleados en orden alfabético ascendente
        $datos = $this->findAll();
        return $datos;
    }
    public function total()
    {
        $this->select('empleados.*, municipios.nombre as NMuni, municipios.estado as estadoMuni, cargos.nombre as NCargo, cargos.estado as estadoCargo, departamentos.nombre as dpto_nombre, departamentos.estado as estadoDpto, paises.nombre as pais_nombre, paises.estado as estadoPais');
        $this->join('municipios', 'municipios.id = empleados.id_municipio');
        $this->join('departamentos', 'municipios.id_dpto = departamentos.id');
        $this->join('paises', 'departamentos.id_pais = paises.id');
        $this->join('cargos', 'cargos.id = empleados.id_cargo');
        // $this->join('salarios', 'salarios.id_empleado = empleados.id', 'left');
        $this->orderBy('nombres', 'ASC'); // ordena por el nombre de los empleados en orden alfabético ascendente
        $datos = $this->findAll();
        return $datos;
    }
    public function residencia()
    {
        $this->select('municipios.nombre as NMuni, municipios.estado as estadoMuni, departamentos.nombre as dpto_nombre, departamentos.estado as estadoDpto, paises.nombre as pais_nombre, paises.estado as estadoPais');
        $this->join('municipios', 'municipios.id = empleados.id_municipio');
        $this->join('departamentos', 'municipios.id_dpto = departamentos.id');
        $this->join('paises', 'departamentos.id_pais = paises.id');
        $this->join('cargos', 'cargos.id = empleados.id_cargo');
        // $this->join('salarios', 'salarios.id_empleado = empleados.id', 'left');
        $this->orderBy('nombres', 'ASC'); // ordena por el nombre de los empleados en orden alfabético ascendente
        $datos = $this->findAll();
        return $datos;
    }
    public function obtenerUltimo()
    {
        $id = $this->getInsertID();
        return $id; 
    }
    public function traer_Emp($id)
    {
        $this->select('empleados. id, nombres, apellidos,id_municipio, id_cargo, empleados.estado, nacimiento, municipios.nombre as NMuni, cargos.nombre as NCargo, departamentos.id as dpto_id, departamentos.nombre as dpto_nombre, paises.id as pais_id, paises.nombre as pais_nombre');
        $this->join('municipios', 'empleados.id_municipio = municipios.id');
        $this->join('departamentos', 'municipios.id_dpto = departamentos.id');
        $this->join('paises', 'departamentos.id_pais = paises.id');
        $this->join('cargos', 'empleados.id_cargo = cargos.id');
        $this->where('empleados.id', $id);
        $this->where('empleados.estado', 'A');
        $datos = $this->first();  // nos trae el registro que cumpla con una condicion dada 
        return $datos;
    }
    public function elimina_Emp($id, $estado)
    {
        $datos = $this->update($id, ['estado' => $estado]);
        return $datos;
    }
    public function obtenerEmpleadosEliminados()
    {
        $this->select('empleados.*, municipios.nombre as NMuni, municipios.estado as estadoMuni, cargos.nombre as NCargo, cargos.estado as estadoCargo, departamentos.nombre as dpto_nombre, departamentos.estado as estadoDpto, paises.nombre as pais_nombre, paises.estado as estadoPais');
        $this->join('municipios', 'municipios.id = empleados.id_municipio');
        $this->join('departamentos', 'municipios.id_dpto = departamentos.id');
        $this->join('paises', 'departamentos.id_pais = paises.id');
        $this->join('cargos', 'cargos.id = empleados.id_cargo');
        $this->where('empleados.estado', 'E');
        $this->orderBy('nombres', 'ASC');
        $datos = $this->findAll();
        return $datos;
    }

    // Validacion de Inputs
    public function validar_Campo($campo, $columna)
    {
        $this->select('empleados. id', $columna);
        $this->where($columna, $campo);
        $datos = $this->first();  // nos trae el registro que cumpla con una condicion dada 
        return $datos;
    }
}
