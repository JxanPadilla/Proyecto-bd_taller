<?php

namespace App\Models; //Reservamos el espacio de nombre de la ruta app\models

use CodeIgniter\Model;

class MunicipiosModel extends Model{
    protected $table      = 'municipios'; /* nombre de la tabla modelada/*/
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true; /* Si la llave primaria se genera con autoincremento*/

    protected $returnType     = 'array';  /* forma en que se retornan los datos */
    protected $useSoftDeletes = false; /* si hay eliminacion fisica de registro */

    protected $allowedFields = ['id_dpto','nombre','estado','fecha_crea']; /* relacion de campos de la tabla */

    protected $useTimestamps = true; /*tipo de tiempo a utilizar */
    protected $createdField  = 'fecha_crea'; /*fecha automatica para la creacion */
    protected $updatedField  = ''; /*fecha automatica para la edicion */
    protected $deletedField  = ''; /*no se usara, es para la eliminacion fisica */

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation    = false;

    public function traer_Municipios($id){
        $this->select('municipios.*,departamentos.nombre as nombre_dpto, paises.nombres as nombre_pais, paises.id as id_pais');
        $this->join('departamentos', 'departamentos.id = municipios.id_dpto');
        $this->join('paises', 'paises.id = departamentos.id_pais');  
        $this->where('municipios.id', $id);
        $datos = $this->first();  // nos trae el registro que cumpla con una condicion dada 
        return $datos;
    }

    public function traer_paisMuni($id){
        $this->select('municipios.*');
        $this->where('id_dpto', $id);
        $this->where('estado', 'A');
        $datos = $this->findAll();  // nos trae el registro que cumpla con una condicion dada 
        return $datos;
    }

    public function obtenerMunicipios(){
        $this->select('municipios.*,departamentos.nombre as nombre_dpto, paises.nombres as nombre_pais');
        $this->join('departamentos', 'departamentos.id = municipios.id_dpto');
        $this->join('paises', 'paises.id = departamentos.id_pais');  
        $this->where('municipios.estado', 'A');
        $datos = $this->findAll();  // nos trae el registro que cumpla con una condicion dada 
        return $datos;
    }
   

    public function elimina_Municipios($id,$estado){
        $datos = $this->update($id, ['estado' => $estado]);        
        return $datos;
    }
 
    public function eliminados_municipios(){
        $this->select('municipios.*,paises.nombres as nombre_pais, departamentos.nombre as nombre_dpto ');
        $this->join('departamentos', 'departamentos.id = municipios.id_dpto');
        $this->join('paises', 'paises.id = departamentos.id_pais');  
        $this->where('municipios.estado', 'E');
        $datos = $this->findAll();  // nos trae el registro que cumpla con una condicion dada 
        return $datos;
    }
 

}
