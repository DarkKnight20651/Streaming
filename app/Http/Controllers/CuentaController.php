<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\proveedor;
use App\Models\cuenta;
use App\Models\perfile;

class cuentaController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:ver-cuenta|crear-cuenta|editar-cuenta|borrar-cuenta')->only('index');
         $this->middleware('permission:crear-cuenta', ['only' => ['create','store']]);
         $this->middleware('permission:editar-cuenta', ['only' => ['edit','update']]);
         $this->middleware('permission:borrar-cuenta', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //Con paginación
         $cuentas = cuenta::all();
         return view('cuentas.index',compact('cuentas'));
         //al usar esta paginacion, recordar poner en el el index.blade.php este codigo  {!! $cuentas->links() !!}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
{
    $proveedores = proveedor::all();
    return view('cuentas.crear', compact('proveedores'));
}
public function ver_perfiles(Request $request)
{
    
    $id=$request->input('id_cuenta');
    if($id==null){
        $id = session('id_cuenta');
    }
    // Asumiendo que tienes un modelo 'Perfil' y una relación con 'Cuenta'
    // Puedes obtener los perfiles asociados al ID de la cuenta de la siguiente manera:
    $perfiles = perfile::where('id_cuenta', $id)->get();
    
    // Usar compact para devolver los perfiles
    return view('cuentas.ver_perfiles', compact('perfiles','id'));
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            
        ]);

        cuenta::create($request->all());

        return redirect()->route('cuentas.index');
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
    public function edit(cuenta $cuenta)
    {
        return view('cuentas.editar',compact('cuenta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cuenta $cuenta)
    {
         request()->validate([
            'titulo' => 'required',
            'contenido' => 'required',
        ]);

        $cuenta->update($request->all());

        return redirect()->route('cuentas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(cuenta $cuenta)
    {
        $cuenta->delete();

        return redirect()->route('cuentas.index');
    }
}
