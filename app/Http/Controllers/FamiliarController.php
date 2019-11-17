<?php

namespace App\Http\Controllers;

use App\Empleado;
use App\Familiar;
use Illuminate\Validation\Validator;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\This;

class FamiliarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$employeeId)
    {
        (new TotalController)->checkRole($employeeId,$request);
        $family = Familiar::where('idEmpleado', $employeeId)->get();
        $employee = Empleado::find($employeeId);
        return view('familiar.index'
            , compact('family')
            , compact('employee'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($employeeId)
    {
        return view('familiar.create', compact('employeeId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store($employeeId, Request $request)
    {
        $this->validate($request,[
            'nombre' => 'regex:/^[a-zA-Z]+$/u',
            'segundoNombre' => 'regex:/^[a-zA-Z]+$/u | nullable',
            'apellidoPaterno' => 'regex:/^[a-zA-Z]+$/u',
            'apellidoMaterno' => 'regex:/^[a-zA-Z]+$/u | nullable',
            'ci' => 'numeric | unique:Familiar'
        ],[
            'regex' => 'Los caracteres no son validos',
            'numeric' => 'Debe ser numero',
            'unique' => 'No se puede repetir'
        ]);
        $familiar = new Familiar();
        $familiar->nombre = ucfirst($request->get('nombre'));
        $familiar->segundoNombre = ucfirst($request->get('segundoNombre'));
        $familiar->apellidoPaterno = ucfirst($request->get('apellidoPaterno'));
        $familiar->apellidoMaterno = ucfirst($request->get('apellidoMaterno'));
        $familiar->ci = $request->get('ci');
        $familiar->idEmpleado = $employeeId;
        $familiar->tipoRelacion = $request->get('relations');
        $familiar->save();
        return redirect()->route('empleados.familiares.index', $employeeId);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$employeeId, $familiarId)
    {
        (new TotalController)->checkRole($employeeId,$request);
        $employee = Empleado::find($employeeId);
        $familiar = Familiar::find($familiarId);
        return view('familiar.edit'
            , compact('employee')
            , compact('familiar'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $employeeId, $familiarId)
    {
        (new TotalController)->checkRole($employeeId,$request);
        $familiar = Familiar::find($familiarId);
        $this->validate($request,[
            'nombre' => 'regex:/^[a-zA-Z]+$/u',
            'segundoNombre' => 'regex:/^[a-zA-Z]+$/u | nullable',
            'apellidoPaterno' => 'regex:/^[a-zA-Z]+$/u',
            'apellidoMaterno' => 'regex:/^[a-zA-Z]+$/u | nullable',
            'ci' => 'numeric'
        ],[
            'regex' => 'Los caracteres no son validos',
            'numeric' => 'Debe ser numero',
        ]);
        $familiar->update($request->all());

        return redirect()->route('empleados.familiares.index', $employeeId);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($employeeId, $familiarId)
    {
        $familiar = Familiar::find($familiarId);
        $familiar->delete();

        return redirect()->route('empleados.familiares.index', $employeeId);
    }
}
