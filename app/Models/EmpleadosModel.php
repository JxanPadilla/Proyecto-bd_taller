<?php

namespace App\Models; //Reservamos el espacio de nombre de la ruta app\models

use CodeIgniter\Model;

class EmpleadosModel extends Model{
    protected $table      = 'empleados'; /* nombre de la tabla modelada/*/
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true; /* Si la llave primaria se genera con autoincremento*/

    protected $returnType     = 'array';  /* forma en que se retornan los datos */
    protected $useSoftDeletes = false; /* si hay eliminacion fisica de registro */

    protected $allowedFields = ['nombres', 'apellidos', 'id_municipio', 'nacimiento', 'id_cargo', 'estado','fecha_crea']; /* relacion de campos de la tabla */

    protected $useTimestamps = true; /*tipo de tiempo a utilizar */
    protected $createdField  = 'fecha_crea'; /*fecha automatica para la creacion */
    protected $updatedField  = ''; /*fecha automatica para la edicion */
    protected $deletedField  = ''; /*no se usara, es para la eliminacion fisica */

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation    = false;


    public function traer_Empleados($id){
        $this->select('empleados.*,municipios.nombre as nombreMuni, cargos.nombre as nombreCargo,departamentos.id as id_dpto, paises.id as id_Pais, salarios.sueldo as salario, salarios.id as id_salario, salarios.periodo as periodo');
        $this->join('municipios', 'municipios.id = empleados.id_municipio');
        $this->join('departamentos', 'departamentos.id = municipios.id_dpto');
        $this->join('paises', 'paises.id = departamentos.id_pais');
        $this->join('salarios', 'salarios.id_empleado = empleados.id', 'left');
        $this->join('cargos', 'cargos.id = empleados.id_cargo');
        $this->where('empleados.id', $id);  
        $datos = $this->first();  // nos trae el registro que cumpla con una condicion dada 
        return $datos;
    }

    public function obtenerEmpleados(){
        $this->select('empleados.*,municipios.nombre as nombreMuni, cargos.nombre as nombreCargo, departamentos.nombre as nombre_dpto, paises.nombres as nombrePais, salarios.sueldo as salario, salarios.id as id_salario, salarios.periodo as periodo');
        $this->join('municipios', 'municipios.id = empleados.id_municipio');
        $this->join('departamentos', 'departamentos.id = municipios.id_dpto');
        $this->join('paises', 'paises.id = departamentos.id_pais');
        $this->join('salarios', 'salarios.id_empleado = empleados.id', 'left');
        $this->join('cargos', 'cargos.id = empleados.id_cargo');
        $this->where('empleados.estado', 'A');
        $this->orderBy('empleados.id');
        // $this->orderBy('empleados.nombres');
        $datos = $this->findAll();  // nos trae el registro que cumpla con una condicion dada 
        return $datos;
    }

    public function elimina_Empleados($id,$estado){
        $datos = $this->update($id, ['estado' => $estado]);        
        return $datos;
    }
 
    public function eliminados_empleados(){
        $this->select('empleados.*,municipios.nombre as nombreMuni, cargos.nombre as nombreCargo, departamentos.nombre as nombre_dpto, paises.nombres as nombrePais, salarios.sueldo as salario, salarios.id as id_salario, salarios.periodo as periodo');
        $this->join('municipios', 'municipios.id = empleados.id_municipio');
        $this->join('departamentos', 'departamentos.id = municipios.id_dpto');
        $this->join('paises', 'paises.id = departamentos.id_pais');
        $this->join('salarios', 'salarios.id_empleado  = empleados.id', 'left');
        $this->join('cargos', 'cargos.id = empleados.id_cargo');
        $this->where('empleados.estado', 'E');
        $this->orderBy('empleados.id');
        $datos = $this->findAll();  // nos trae el registro que cumpla con una condicion dada 
        return $datos;
    }
    


}
