<?php

namespace App\Models; //Reservamos el espacio de nombre de la ruta app\models

use CodeIgniter\Model;

class DepartamentosModel extends Model
{
    protected $table = 'departamentos'; /* nombre de la tabla modelada/*/
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true; /* Si la llave primaria se genera con autoincremento*/

    protected $returnType = 'array'; /* forma en que se retornan los datos */
    protected $useSoftDeletes = false; /* si hay eliminacion fisica de registro */

    protected $allowedFields = ['nombre', 'id_pais', 'estado', 'fecha_crea']; /* relacion de campos de la tabla */

    protected $useTimestamps = true; /*tipo de tiempo a utilizar */
    protected $createdField = 'fecha_crea'; /*fecha automatica para la creacion */
    protected $updatedField = ''; /*fecha automatica para la edicion */
    protected $deletedField = ''; /*no se usara, es para la eliminacion fisica */

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    public function obtenerDepartamentos()
    {
        $this->select('departamentos.*, paises.nombre as PNombre, paises.estado as estadoPais');
        $this->join('paises', 'paises.id = departamentos.id_pais');
        $this->where('departamentos.estado', 'A');
        $this->orderBy('paises.nombre', 'ASC');
        $datos = $this->findAll();
        return $datos;
    }
    public function obtenerDepartamentosPais($id)
    {
        $this->select('departamentos.*');
        $this->where('id_pais', $id);
        $datos = $this->findAll();
        return $datos;
    }
    public function traer_Dpto($id)
    {
        $this->select('departamentos.*, paises.nombre as PNombre');
        $this->join('paises', 'paises.id = departamentos.id_pais');
        $this->where('departamentos.id', $id);
        $this->where('departamentos.estado', 'A');
        $datos = $this->first();  // nos trae el registro que cumpla con una condicion dada 
        return $datos;
    }
    public function obtenerDptosEliminados()
    {
        $this->select('departamentos.*, paises.nombre as PNombre, paises.estado as estadoPais');
        $this->join('paises', 'paises.id = departamentos.id_pais');
        $this->where('departamentos.estado', 'E');
        $this->orderBy('paises.nombre', 'ASC');
        $datos = $this->findAll();
        return $datos;
    }
    public function cambiar_Estado($id, $estado)
    {
        $datos = $this->update($id, ['estado' => $estado]);
        return $datos;
    }
    public function validar_Nombre($nombre)
    {
        $this->select('departamentos. nombre');
        $this->where('nombre', $nombre);
        $datos = $this->first();  // nos trae el registro que cumpla con una condicion dada 
        return $datos;
    }
    public function validar_Campo($campo, $columna)
    {
        $this->select('departamentos.' . $columna . ' as valor_comparar');
        $this->where($columna, $campo);
        $datos = $this->first();  // nos trae el registro que cumpla con una condicion dada 
        return $datos;
    }
}
