<?php

namespace App\Http\Controllers;

use App\Asistencia;
use App\Cargo;
use App\Empleado;
use App\Referencia;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
    }

    public function assistance()
    {

        $employees = Empleado::all();
        $empleados = $employees->where('working', '=', true);
        return view('asistencias.index', compact('empleados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    public function check(Request $request)
    {
        $user = $request->get('user');
        $password = $request->get('password');
        $employees = Empleado::all();
        $employee = $employees->where('usuario', '=', $user)->first();
        if (Hash::check($password, $employee->contrasena)) {
            return redirect("/");
        } else {
            dd("Wrong");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'firstName' => 'regex:/^[a-zA-Z]+$/u',
            'secondName' => 'regex:/^[a-zA-Z]+$/u|nullable',
            'fatherName' => 'regex:/^[a-zA-Z]+$/u',
            'motherName' => 'regex:/^[a-zA-Z]+$/u|nullable',
            'ci' => 'numeric | unique:Empleado',
            'rfidCode' => 'numeric | unique:Empleado',
            'phone' => 'numeric'
        ],[
            'regex' => 'Los caracteres no son validos',
            'numeric' => 'Debe ser numero',
            'unique' => 'Este valor ya existe'
        ]);
        $employee = new Empleado();
        $employee->ci = $request->get('ci');
        $employee->nombre = ucfirst($request->get('firstName'));
        $employee->segundoNombre = ucfirst($request->get('secondName'));
        $employee->apellidoPaterno = ucfirst($request->get('fatherName'));
        $employee->apellidoMaterno = ucfirst($request->get('motherName'));
        $employee->estadoCivil = $request->get('civilStatus');
        $employee->genero = $request->get('gender');
        $employee->celular = $request->get('phone');
        $employee->fechaNacimiento = $request->get('birthdate');
        $employee->usuario = strtolower($employee->nombre[0] . $employee->apellidoPaterno);
        $employee->password = Hash::make($employee->ci);
        $employee->idCargo = $request->get('idCargo');
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = time() . $file->getClientOriginalName();
            $file->move('images/', $name);
            $employee->fotografia = $name;
        } else {
            $employee->fotografia = '';
        }

        $employee->idRol = $request->get('idRol');
        $employee->activo = $request->get('active');
        $employee->rfidCode = $request->get('rfid');
        $employee->save();
        return redirect('/');
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {

        (new TotalController)->checkRole($id,$request);
        $empleado = Empleado::find($id);
        $cargos = Cargo::all();
        $referencia = Referencia::all();
        return view('login.show', compact('referencia'))->with('empleado', $empleado)->with('cargos', $cargos);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        (new TotalController)->checkRole($id,$request);
        $empleado = Empleado::find($id);
        $cargos = Cargo::all();
        return view('login.edit')->with('empleado', $empleado)->with('cargos', $cargos);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        (new TotalController)->checkRole($id,$request);
        $this->validate($request,[
            'firstName' => 'regex:/^[a-zA-Z]+$/u',
            'secondName' => 'regex:/^[a-zA-Z]+$/u|nullable',
            'fatherName' => 'regex:/^[a-zA-Z]+$/u',
            'motherName' => 'regex:/^[a-zA-Z]+$/u|nullable',
            'ci' => 'numeric',
            'rfidCode' => 'numeric',
            'phone' => 'numeric'
        ],[
            'regex' => 'Los caracteres no son validos',
            'numeric' => 'Debe ser numero',
            'unique' => 'Este valor ya existe'
        ]);

        $employee = Empleado::findOrFail($id);
        $employee->ci = $request->get('ci');
        $employee->nombre = $request->get('firstName');
        $employee->segundoNombre = $request->get('secondName');
        $employee->apellidoPaterno = $request->get('fatherName');
        $employee->apellidoMaterno = $request->get('motherName');
        $employee->genero = $request->get('gender');
        //$employee->usuario = $request->get('user');
        // $employee->contrasena = Hash::make($request->get('password'));
        $employee->idCargo = $request->get('idCargo');
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = time() . $file->getClientOriginalName();
            $file->move('images/', $name);
            $employee->fotografia = $name;
        }
        $employee->idRol = 3;
        $employee->rfidCode = $request->get('rfid');
        $employee->save();
        return redirect("/")->with('employee', $employee);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->get("empleado-id");
        $empleado = Empleado::find($id);
        $empleado->delete();
        return redirect("/");
    }

    public function inactive(Request $request)
    {
        $number = $request->get('idEmpleado');
        $empleado = Empleado::find($number);
        $empleado->activo = 0;
        $empleado->save();
        return redirect("/");
    }

    public function compare(Request $request)
    {
        $employees = Empleado::all();
        $number = $request->get('rfidCode');
        if ($request->get('rfidCode')) {
            $empleadito = $employees->where('rfidCode', '=', $number);
            $empleadouno = $empleadito->first();
            if ($empleadouno->working) {
                $sum = 0;
                $empleadouno->working = 0;
                $hour = date('H');
                $hour -= 4;
                $minutes = date(':i');
                $now = Carbon::now()->format('Y/m/d');
                $date = $hour . $minutes;
                $asistencia = $empleadouno->asistencias->last();

                //compare hours
                $hour = Carbon::parse($asistencia->horaEntrada)->tz('America/La_Paz');
                $now = Carbon::now()->tz('America/La_Paz');
                $hours = $now->diffInMinutes($hour, true);
                $sum += (($hours / 60) - 4);
                $string = number_format($sum, 2, '.', '');

                //Guardar asistencia
                $asistencia->horaSalida = $date;
                $asistencia->horasDeTrabajo = $string;
                $asistencia->save();

            } else {
                $hour = date('H');
                $hour -= 4;
                $minutes = date(':i');
                $now = Carbon::now()->format('Y/m/d');
                $date = $hour . $minutes;
                $empleadouno->working = 1;
                $asistencia = new Asistencia();
                $asistencia->horaEntrada = $date;
                $asistencia->fecha = $now;
                $asistencia->idEmpleado = $empleadouno->idEmpleado;
                //Solo cuando ingresa
                $json = json_decode(file_get_contents('http://localhost:8080'), true);
                $asistencia->save();
            }
            $empleadouno->save();
        }

        $empleaditos = $employees->where('working', '=', true);
        return view('asistencias.compare', compact('empleaditos'));
    }


}

