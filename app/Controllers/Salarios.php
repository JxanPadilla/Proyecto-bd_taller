<?php

namespace App\Controllers;

use App\Controllers\BaseController; /*la plantilla del controlador general de codeigniter */
use App\Models\SalariosModel;
class Salarios extends BaseController    
{    
    protected $salarios;
    public function __construct()
    {
        $this -> salarios = new SalariosModel();
    }
        public function index() 
        {   
            $salarios= $this->salarios->where('estado', "A")->findAll();         
            $data = ['titulo' => 'Proyecto Taller','nombre'=>'Juan Padilla','salarios'=>$salarios]; // le asignamos a la variable data, que es la que interactua con la vista, los datos obtenidos del modelo, ademas de enviarle una variable titulo para el reporte.
            echo view('/principal/header' , $data);


            //echo view('/principal/principal',$data); //mostramos la vista desde el controlador y le enviamos la data necesaria, en este caso, estamos enviando el titulo
        }     

        public function buscar_Salarios($id)
    {
        $returnData = array();
        $salarios_ = $this->salarios->traer_Salarios($id);
        if (!empty($salarios_)) {
            array_push($returnData, $salarios_);
        }
        echo json_encode($returnData);
    }

    // public function insertar()
    // {
    //     $tp=$this->request->getPost('tp');
    //     if ($this->request->getMethod() == "post") {
    //         if ($tp == 1) {
    //             $this->paises->save([
    //                 'codigo' => $this->request->getPost('codigo'),
    //                 'nombres' => $this->request->getPost('nombre')
    //             ]);
    //         } else {
    //             $this->paises->update($this->request->getPost('id'),[
    //                 'codigo' =>$this->request->getPost('codigo'),           
    //                 'nombres'=> $this->request->getPost('nombre')
    //             ]);

    //         }
    //         return redirect()->to(base_url('/paises'));
    //     }
    // }
    
}






