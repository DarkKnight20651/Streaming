<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cliente;
use App\Models\perfile;
use App\Models\user;
use Carbon\Carbon;

class perfileController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ver-perfile|crear-perfile|editar-perfile|borrar-perfile')->only('index');
         $this->middleware('permission:crear-perfile', ['only' => ['create','store']]);
         $this->middleware('permission:editar-perfile', ['only' => ['edit','update']]);
         $this->middleware('permission:borrar-perfile', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Cargar los perfiles con las relaciones de cuenta y cliente usando Eager Loading
        $perfiles = perfile::with(['cuenta', 'cliente'])->get();

        return view('perfiles.index', compact('perfiles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
{   $id=$request->input('id_cuenta');
    $clientes = cliente::all();
    
    return view('perfiles.crear', compact('clientes','id'));
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
// En el método 'store' del controlador
public function store(Request $request)
{
    $request->validate([
        'id_cuenta' => 'required',
        'nombre' => 'required',
        'pin' => 'required|numeric',
        'precio' => 'required|numeric',
        'pagado' => 'required|numeric',
        'id_usuario' => 'required',
    ]);

    // Calcular la fecha de vencimiento
    $fecha_vencimiento = Carbon::now()->addDays(30);
    $id_cuenta = $request->id_cuenta;
    $perfil = new Perfile();
    $perfil->id_cuenta = $request->id_cuenta;
    $perfil->nombre = $request->nombre;
    $perfil->pin = $request->pin;
    $perfil->precio = $request->precio;
    $perfil->pagado = $request->pagado;
    $perfil->dias_restantes = $request->dias_restantes;
    $perfil->id_usuario = $request->id_usuario;
     
    $perfil->save();
    return redirect()->route('cuentas.ver_perfiles')->with('id_cuenta',$id_cuenta);
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(perfile $perfile)
    {
        $clientes = cliente::all();
        return view('perfiles.editar',compact('perfile','clientes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, perfile $perfile)
    {
         request()->validate([
            
        ]);

        $perfile->update($request->all());

        return redirect()->route('perfiles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(perfile $perfile)
    {
        $id_cuenta=$perfile->id_cuenta;
        $perfile->delete();

        return redirect()->route('cuentas.ver_perfiles')->with('id_cuenta',$id_cuenta);
    }
    public function renew(Request $request)
    {
        $id_perfil=$request->id_perfil;
        
        $perfil = perfile::find($id_perfil);
        $id_cuenta=$perfil->id_cuenta;
        $perfil->dias_restantes = Carbon::parse($perfil->dias_restantes)->addDays(30);

        // Guarda los cambios en la base de datos
        $perfil->save();
        return redirect()->route('cuentas.ver_perfiles')->with('id_cuenta',$id_cuenta);
    }
}
