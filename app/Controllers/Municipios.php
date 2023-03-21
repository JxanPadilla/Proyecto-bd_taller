<?php

namespace App\Controllers;

use App\Controllers\BaseController; /*la plantilla del controlador general de codeigniter */
use App\Models\MunicipiosModel;
use App\Models\DepartamentosModel;
use App\Models\PaisesModel;
class Municipios extends BaseController    
{    
    protected $municipios;
    protected $departamentos;
    protected $paises;
    public function __construct()
    {
        $this -> municipios = new MunicipiosModel();
        $this -> departamentos = new DepartamentosModel();
        $this -> paises = new PaisesModel();
    }
        public function index() 
        {   
            $municipios= $this-> municipios->obtenerMunicipios(); 
            $paises= $this->paises->where('estado', "A")->findAll();    
            $departamentos = $this->departamentos->obtenerDepartamentos();        
            $data = ['titulo' => 'Proyecto Taller','nombre'=>'Juan Padilla','municipios'=>$municipios, 'departamentos'=>$departamentos, 'paises'=>$paises]; // le asignamos a la variable data, que es la que interactua con la vista, los datos obtenidos del modelo, ademas de enviarle una variable titulo para el reporte.
            echo view('/principal/header' , $data);
            echo view('/municipios/municipios', $data);

            //echo view('/principal/principal',$data); //mostramos la vista desde el controlador y le enviamos la data necesaria, en este caso, estamos enviando el titulo
        }    

        public function buscar_dptoPais($id)
    {
        $returnData = array();
        $departamentoss = $this->departamentos->traer_dptoPais($id);
        if (!empty($departamentoss)) {
            array_push($returnData, $departamentoss);
        }
        echo json_encode($departamentoss);
    }

    public function buscar_Municipios($id)
    {
        $returnData = array();
        $municipios_ = $this->municipios->traer_Municipios($id);
        if (!empty($municipios_)) {
            array_push($returnData, $municipios_);
        }
        echo json_encode($returnData);
    }

        public function insertar()
    {
        $tp=$this->request->getPost('tp');
        if ($this->request->getMethod() == "post") {
            if ($tp == 1) {
                $this->municipios->save([
                    'id_dpto' => $this->request->getPost('dpto'),
                    'nombre' => $this->request->getPost('nombre')
                ]);
            } else {
                $this->municipios->update($this->request->getPost('id'),[         
                    'id_dpto' => $this->request->getPost('dpto'),
                    'nombre' => $this->request->getPost('nombre')
                ]);

            }
            return redirect()->to(base_url('/municipios'));
        }
    }

    public function eliminados()
    {
        $municipios = $this->municipios->eliminados_municipios();
        $paises= $this->paises->where('estado', "A")->findAll();
        $departamentos = $this->departamentos->obtenerDepartamentos();
        $data = ['titulo' => 'MUNICIPIOS ELIMINADOS', 'titulo' => 'Proyecto Taller','nombre'=>'Juan Padilla', 'departamentos' => $departamentos, 'municipios'=>$municipios, 'paises' => $paises];
        echo view('/principal/header', $data);
        echo view('municipios/eliminados', $data);
       
    }

    public function eliminar($id,$estado){
        $municipios_ = $this->municipios->elimina_Municipios($id,$estado);
        return redirect()->to(base_url('/municipios'));
    }

}
