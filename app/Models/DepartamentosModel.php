<?php

namespace App\Models; //Reservamos el espacio de nombre de la ruta app\models

use CodeIgniter\Model;


class DepartamentosModel extends Model{
    protected $table      = 'departamentos'; /* nombre de la tabla modelada/*/
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true; /* Si la llave primaria se genera con autoincremento*/

    protected $returnType     = 'array';  /* forma en que se retornan los datos */
    protected $useSoftDeletes = false; /* si hay eliminacion fisica de registro */

    protected $allowedFields = ['id_pais','nombre','estado','fecha_crea']; /* relacion de campos de la tabla */

    protected $useTimestamps = true; /*tipo de tiempo a utilizar */
    protected $createdField  = 'fecha_crea'; /*fecha automatica para la creacion */
    protected $updatedField  = ''; /*fecha automatica para la edicion */
    protected $deletedField  = ''; /*no se usara, es para la eliminacion fisica */

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation    = false;

    
    public function traer_Departamentos($id){
        $this->select('departamentos.*');      
        $this->where('id', $id);
        $datos = $this->first();  // nos trae el registro que cumpla con una condicion dada 
        return $datos;
    }
     public function obtenerDepartamentos(){
         $this->select('departamentos.*,paises.nombres as nombre_pais');
         $this->join('paises', 'paises.id = departamentos.id_pais');
         $this->where('departamentos.estado', 'A');
         $datos = $this->findAll();  // nos trae el registro que cumpla con una condicion dada 
         return $datos;
     }

     public function elimina_Departamentos($id,$estado){
        $datos = $this->update($id, ['estado' => $estado]);        
        return $datos;
    }
 
    public function eliminados_departamentos(){
        $this->select('departamentos.*,paises.nombres as nombre_pais');
        $this->join('paises', 'paises.id = departamentos.id_pais');
        $this->where('departamentos.estado', 'E');
        $datos = $this->findAll();  // nos trae el registro que cumpla con una condicion dada 
        return $datos;
    }

}
