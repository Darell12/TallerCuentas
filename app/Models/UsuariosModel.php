<?php

namespace App\Models; //Reservamos el espacio de nombre de la ruta app\models

use CodeIgniter\Model;

class UsuariosModel extends Model
{
    protected $table = 'usuarios'; /* nombre de la tabla modelada/*/
    protected $primaryKey = 'id_usuario';

    protected $useAutoIncrement = true; /* Si la llave primaria se genera con autoincremento*/

    protected $returnType = 'array'; /* forma en que se retornan los datos */
    protected $useSoftDeletes = false; /* si hay eliminacion fisica de registro */

    protected $allowedFields = ['tipo_documento', 'email', 'n_documento', 'nombre_p', 'nombre_s', 'apellido_p', 'apellido_s', 'contraseña', 'estado', 'fecha_crea']; /* relacion de campos de la tabla */

    protected $useTimestamps = true; /*tipo de tiempo a utilizar */
    protected $createdField = 'fecha_crea'; /*fecha automatica para la creacion */
    protected $updatedField = ''; /*fecha automatica para la edicion */
    protected $deletedField = ''; /*no se usara, es para la eliminacion fisica */

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

    public function obtenerUsuarios()
    {
        $this->select('usuarios.*');
        $this->where('estado', 'A');
        $datos = $this->findAll();
        return $datos;
    }
    public function obtenerUsuariosEliminados()
    {
        $this->select('usuarios.*');
        $this->where('estado', 'E');
        $this->orderBy('nombre_p', 'ASC');
        $datos = $this->findAll();
        return $datos;
    }
    public function buscarUsuario($id)
    {
        $this->select('usuarios.*');
        $this->where('id_usuario', $id);
        $this->where('estado', 'A');
        $datos = $this->first();
        return $datos;
    }
    public function login($email)
    {
        $this->select('usuarios.*');
        $this->where('email', $email);
        $this->where('estado', 'A');
        $datos = $this->findAll();
        return $datos;
    }
    public function cambiar_Estado($id, $estado)
    {
        $datos = $this->update($id, ['estado' => $estado]);
        return $datos;
    }
}
