<?php

namespace App\Models; //Reservamos el espacio de nombre de la ruta app\models

use CodeIgniter\Model;

class CargosModel extends Model
{
    protected $table = 'cargos'; /* nombre de la tabla modelada/*/
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true; /* Si la llave primaria se genera con autoincremento*/

    protected $returnType = 'array'; /* forma en que se retornan los datos */
    protected $useSoftDeletes = false; /* si hay eliminacion fisica de registro */

    protected $allowedFields = ['nombre', 'estado', 'fecha_crea']; /* relacion de campos de la tabla */

    protected $useTimestamps = true; /*tipo de tiempo a utilizar */
    protected $createdField = 'fecha_crea'; /*fecha automatica para la creacion */
    protected $updatedField = ''; /*fecha automatica para la edicion */
    protected $deletedField = ''; /*no se usara, es para la eliminacion fisica */

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    public function obtenerCargos()
    {
        $this->select('cargos.*');
        $this->where('estado', 'A');
        $this->orderBy('nombre', 'ASC');
        $datos = $this->findAll();
        return $datos;
    }
    public function traer_Cargo($id)
    {
        $this->select('cargos.*');
        $this->where('cargos.id', $id);
        $this->where('estado', 'A');
        $datos = $this->first();  // nos trae el registro que cumpla con una condicion dada 
        return $datos;
    }
    public function cambiar_Estado($id, $estado)
    {
        $datos = $this->update($id, ['estado' => $estado]);
        return $datos;
    }
    public function obtenerCargosEliminados()
    {
        $this->select('cargos.*');
        $this->orderBy('nombre', 'ASC');
        $this->where('estado', 'E');
        $datos = $this->findAll();
        return $datos;
    }
    public function validar_Campo($campo, $columna)
    {
        $this->select('cargos.' . $columna . ' as valor_comparar');
        $this->where($columna, $campo);
        $datos = $this->first();  // nos trae el registro que cumpla con una condicion dada 
        return $datos;
    }
}
