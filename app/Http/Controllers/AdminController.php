<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Datatables;
use DB;
use App\Proyecto;

class AdminController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$proyectos = DB::table('tecnologiaproyecto')->select('titulo, descripcion');
        //$proyectos = DB::select('select * from tecnologiaproyecto');
        $proyectos = DB::select('select proy.idProyecto,tp.titulo, inst.nombreInstitucion,ti.descripcion
from proyecto as proy INNER JOIN tecnologiaproyecto as tp ON proy.fk_idTecnologiaProyecto = tp.idTecnologiaProyecto
 INNER JOIN institucion as inst ON tp.fk_idInstitucion=inst.idInstitucion
INNER JOIN tipoinvencion as ti ON tp.fk_idTipoInvencion=ti.idTipoInvencion'); //Tecnologia::all();
        return view('datatable', ['proyectos'=>$proyectos]);
    }

    public function editar($id){
        $proyecto = Proyecto::find($id);
        if($proyecto){
           return view('detalleProyecto', ["proyecto"=>$proyecto]);
        }else{
            return redirect()->back()->with('nodelete_code', 5);
        }

    }

    public function actualizar(Request $request){
        //actualizar

        //redirigir a AdminController@Index
    }

    public function eliminar($id){
        //eliminar
        $proyecto = Proyecto::find($id);
        $deleted = $proyecto->delete();
        if($deleted){
            return redirect()->back()->with('delete_code', 5);
        }else{
            return redirect()->back()->with('nodelete_code', 5);
        }

        //redirigir a AdminController@Index
    }
}
