<?php

namespace App\Models; //Reservamos el espacio de nombre de la ruta app\models

use CodeIgniter\Model;

class PaisesModel extends Model
{
    protected $table = 'paises'; /* nombre de la tabla modelada/*/
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true; /* Si la llave primaria se genera con autoincremento*/

    protected $returnType = 'array'; /* forma en que se retornan los datos */
    protected $useSoftDeletes = false; /* si hay eliminacion fisica de registro */

    protected $allowedFields = ['nombre', 'estado', 'codigo', 'fecha_crea']; /* relacion de campos de la tabla */

    protected $useTimestamps = true; /*tipo de tiempo a utilizar */
    protected $createdField = 'fecha_crea'; /*fecha automatica para la creacion */
    protected $updatedField = ''; /*fecha automatica para la edicion */
    protected $deletedField = ''; /*no se usara, es para la eliminacion fisica */

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    public function obtenerPaises()
    {
        $this->select('paises.*');
        $this->where('estado', 'A');
        $datos = $this->findAll();
        return $datos;
    }
    public function obtenerPaisesEliminados()
    {
        $this->select('paises.*');
        $this->where('estado', 'E');
        $datos = $this->findAll();
        return $datos;
    }
    public function traer_Pais($id)
    {
        $this->select('paises.*');
        $this->where('id', $id);
        $this->where('estado', 'A');
        $datos = $this->first();  // nos trae el registro que cumpla con una condicion dada 
        return $datos;
    }
    public function validar_codigo($codigo)
    {
        $this->select('paises. nombre, codigo');
        $this->where('codigo', $codigo);
        $datos = $this->first();  // nos trae el registro que cumpla con una condicion dada 
        return $datos;
    }
    public function validar_Campo($campo, $columna)
    {
        $this->select('paises.' . $columna . ' as valor_comparar' );
        $this->where($columna, $campo);
        $datos = $this->first();  // nos trae el registro que cumpla con una condicion dada 
        return $datos;
    }
    public function cambiar_Estado($id, $estado)
    {
        $datos = $this->update($id, ['estado' => $estado]);
        return $datos;
    }
}
