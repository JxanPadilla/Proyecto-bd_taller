<?php

namespace App\Controllers;

use App\Controllers\BaseController; /*la plantilla del controlador general de codeigniter */
use App\Models\EmpleadosModel;
use App\Models\MunicipiosModel;
use App\Models\CargosModel;
use App\Models\PaisesModel;
use App\Models\SalariosModel;
use App\Models\DepartamentosModel;

class Empleados extends BaseController
{
    protected $empleados;
    protected $cargos;
    protected $municipios;
    protected $paises;
    protected $departamentos;
    protected $salarios;
    public function __construct()
    {
        $this->empleados = new EmpleadosModel();
        $this->departamentos = new DepartamentosModel();
        $this->cargos = new CargosModel();
        $this->municipios = new MunicipiosModel();
        $this->paises = new PaisesModel();
        $this->salarios = new SalariosModel();
    }
    public function index()
    {
        $empleados = $this->empleados->obtenerEmpleados();
        $municipios = $this->municipios->obtenerMunicipios();
        $departamentos = $this->departamentos->obtenerDepartamentos();
        $paises = $this->paises->where('estado', "A")->findAll();
        $cargos = $this->cargos->where('estado', "A")->findAll();
        $salarios = $this->salarios->where('estado', "A")->findAll();
        $data = ['titulo' => 'Proyecto Taller', 'nombre' => 'Juan Padilla', 'empleados' => $empleados, 'cargos' => $cargos, 'departamentos' => $departamentos, 'municipios' => $municipios, 'paises' => $paises, 'salarios' => $salarios]; // le asignamos a la variable data, que es la que interactua con la vista, los datos obtenidos del modelo, ademas de enviarle una variable titulo para el reporte.
        echo view('/principal/header', $data);
        echo view('/empleados/empleados', $data);

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

    public function buscar_paisMuni($id)
    {
        $returnData = array();
        $municipioss = $this->municipios->traer_paisMuni($id);
        if (!empty($municipioss)) {
            array_push($returnData, $municipioss);
        }
        echo json_encode($municipioss);
    }


    public function buscar_Empleados($id)
    {
        $returnData = array();
        $empleados_ = $this->empleados->traer_Empleados($id);
        if (!empty($empleados_)) {
            array_push($returnData, $empleados_);
        }
        echo json_encode($returnData);
    }

    public function insertar()
    {
        $tp = $this->request->getPost('tp');
        if ($tp == 1) {
            $this->empleados->save([
                'nombres' => $this->request->getPost('nombre'),
                'apellidos' => $this->request->getPost('apellido'),
                'id_municipio' => $this->request->getPost('muni'),
                'nacimiento' => $this->request->getPost('nacimiento'),
                'id_cargo' => $this->request->getPost('cargo')
            ]);

            $sueldo = $this->request->getPost('salario');
            $periodo = $this->request->getPost('periodo');
            $id_empleado = $this->empleados->getInsertID();

            echo $id_empleado;

            $this->salarios->guardar($sueldo, $periodo, $id_empleado); 

            return redirect()->to(base_url('/empleados'));
        } else {
            $this->empleados->update($this->request->getPost('id'), [
                'nombres' => $this->request->getPost('nombre'),
                'apellidos' => $this->request->getPost('apellido'),
                'id_municipio' => $this->request->getPost('muni'),
                'nacimiento' => $this->request->getPost('nacimiento'),
                'id_cargo' => $this->request->getPost('cargo')

            ]);

            $sueldo = $this->request->getPost('salario');
            $periodo = $this->request->getPost('periodo');
            $sal = $this->request->getPost('sal');

            $this->salarios->actualizar($sueldo, $periodo, $sal); 

            return redirect()->to(base_url('/empleados'));
        }
    }

    public function eliminados()
    {
        $empleados = $this->empleados->eliminados_empleados();
        $municipios = $this->municipios->obtenerMunicipios();
        $cargos = $this->cargos->where('estado', "A")->findAll();
        $data = ['titulo' => 'EMPLEADOS ELIMINADOS', 'titulo' => 'Proyecto Taller', 'nombre' => 'Juan Padilla', 'municipios' => $municipios, 'empleados' => $empleados, 'cargos' => $cargos];
        echo view('/principal/header', $data);
        echo view('empleados/eliminados', $data);
    }

    public function eliminar($id, $estado)
    {
        $empleados_ = $this->empleados->elimina_Empleados($id, $estado);
        return redirect()->to(base_url('/empleados'));
    }
}
