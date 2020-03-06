<?php

namespace App\Http\Controllers;

use App\Cargo;
use App\Empleado;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Charts;
class ReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function hours(Request $request)
    {
        (new TotalController)->checkRoleWithRequest($request);
        $number = 10;
        $filteredCargos = [];
        $names = [];
        $quatities = [];
        $cargos = Cargo::all();
        foreach ($cargos as $cargo) {
            if ($cargo->empleados->count() >= $number){
                $names[] = $cargo->nombre;
                $quatities[] = $cargo->empleados()->count();
                $filteredCargos[] = $cargo;
            }
        }
        $chart  =	 Charts::create('bar', 'highcharts')
            ->title('Reporte de cargos')
            ->labels($names)
            ->values($quatities)
            ->dimensions(1000,500)
            ->responsive(false);

        return view('reports.jobs',compact('chart'))->with('cargos', $filteredCargos);
    }

    public function jobs(Request $request)
    {
        (new TotalController)->checkRoleWithRequest($request);
        $number = 10;
        $filteredCargos = [];
        $names = [];
        $quatities = [];
        $cargos = Cargo::all();
        foreach ($cargos as $cargo) {
            if ($cargo->empleados->count() >= $number){
                $names[] = $cargo->nombre;
                $quatities[] = $cargo->empleados()->count();
                $filteredCargos[] = $cargo;
            }
        }
        $chart  =	 Charts::create('bar', 'highcharts')
            ->title('Reporte de cargos')
            ->labels($names)
            ->values($quatities)
            ->dimensions(1000,500)
            ->responsive(false);

        return view('reports.jobs',compact('chart'))->with('cargos', $filteredCargos);
    }

    public function selectJobs(Request $request)
    {
        $number = $request->get('number');
        $filteredCargos = [];
        $cargos = Cargo::all();
        $names = [];
        $quatities = [];
        foreach ($cargos as $cargo) {
            if ($cargo->empleados->count() >= $number){
                $names[] = $cargo->nombre;
                $quatities[] = $cargo->empleados()->count();
                $filteredCargos[] = $cargo;
            }
        }

        $chart  =	 Charts::create('bar', 'highcharts')
            ->title('Reporte de cargos')
            ->labels($names)
            ->values($quatities)
            ->dimensions(1000,500)
            ->responsive(false);


        return view('reports.jobs',compact('chart'))->with('cargos', $filteredCargos);
    }

    public function civilStatus(Request $request)
    {
        (new TotalController)->checkRoleWithRequest($request);
        $employees = Empleado::all();
        $civilStates = $employees->groupBy('estadoCivil');
        $names = [];
        $quatities = [];
        foreach ($civilStates as $key => $civilState)  {
            $names[] = $key;
            $quatities[] = $civilState->count();
        }
        $chart  =	 Charts::create('bar', 'highcharts')
            ->title('Reporte de empleados segun su estado civil')
            ->labels($names)
            ->values($quatities)
            ->dimensions(1000,500)
            ->responsive(false);
        return view('reports.civilstatus',compact('chart'))->with('civilStates', $civilStates);
    }

    public function child(Request $request)
    {
        (new TotalController)->checkRoleWithRequest($request);
        $employees = Empleado::all();
        $filteredEmployees = [];
        $names = [];
        $quatities = [];
        foreach ($employees as $employee) {
            if ($employee->familiares->where('tipoRelacion', 'Hijo')->count() > 0)
            {
                $filteredEmployees[] = $employee;
                $names[] = $employee -> fullName();
                $quatities[] = $employee -> familiares->where('tipoRelacion', 'Hijo') -> count();
            }
        }

        $chart  =	 Charts::create('bar', 'highcharts')
            ->title('Reporte de Empleado segun cantidad de hijos')
            ->labels($names)
            ->values($quatities)
            ->dimensions(1000,500)
            ->responsive(false);
        return view('reports.familiar',compact('chart'))->with('filteredEmployees', $filteredEmployees);
    }

    public function selectChild(Request $request)
    {
        $number = $request->get('number');
        $employees = Empleado::all();
        $filteredEmployees = [];
        $names = [];
        $quatities = [];
        foreach ($employees as $employee) {
            if ($employee->familiares->where('tipoRelacion', 'Hijo')->count() > $number)
            {
                $filteredEmployees[] = $employee;
                $names[] = $employee -> fullName();
                $quatities[] = $employee -> familiares->where('tipoRelacion', 'Hijo') -> count();
            }
        }

        $chart  =	 Charts::create('bar', 'highcharts')
            ->title('Reporte de Empleado segun cantidad de hijos')
            ->labels($names)
            ->values($quatities)
            ->dimensions(1000,500)
            ->responsive(false);
        return view('reports.familiar',compact('chart'))->with('filteredEmployees', $filteredEmployees);
    }

    public function age(Request $request)
    {
        (new TotalController)->checkRoleWithRequest($request);
        $employees = Empleado::get();
        $names = [];
        $quatities = [];
        foreach ($employees as $employee) {
            $birthDate = Carbon::parse($employee->fechaNacimiento);
            $employee->edad = $birthDate->diffInYears(Carbon::now());
        }
        $emp = $employees->sortByDesc('edad')->groupBy('edad');

        foreach ($emp as $key => $employee)
        {
            $names[] = $key;
            $quatities[] = $employee->count();
        }

        $chart  =	 Charts::create('bar', 'highcharts')
            ->title('Reporte de empleados segun su estado civil')
            ->labels($names)
            ->values($quatities)
            ->dimensions(1000,500)
            ->responsive(false);

        return view('reports.age',compact('chart'))->with('filteredEmployees', $emp);
    }
    public function gender(Request $request)
    {
        (new TotalController)->checkRoleWithRequest($request);
        $nowYear = Carbon::now()->year;
        $employees = Empleado::all();
        $list = [];
        $lastYear = $nowYear - 1;
        $lastLastYear = $nowYear - 2;
        $names =
            [
            "Hombres ".$nowYear,
            "Mujeres ".$nowYear,
            "Hombres ".$lastYear,
            "Mujeres ".$lastYear,
            "Hombres ".$lastLastYear,
            "Mujeres ".$lastLastYear,
            ]
        ;
        $quantities = [0,0,0,0,0,0];


        foreach ($employees as $key => $employee) {
            $flag1 = false;
            $flag2 = false;
            $flag3 = false;
            foreach ($employee->getAsistencias() as $key => $asistencia){
                $year = Carbon::parse($key)->year;

                if ($nowYear == $year && !$flag1){
                    if ($employee->genero == 'M')
                        $quantities[0]++;
                    else if ($employee->genero == 'F')
                        $quantities[1]++;
                    $flag1 = true;
                }
                elseif ( $nowYear-1 == $year && !$flag2){
                    if ($employee->genero == 'M')
                        $quantities[2]++;
                    else
                        $quantities[3]++;
                    $flag2 = true;

                }
                elseif ($nowYear-2 == $year && !$flag3){
                    if ($employee->genero == 'M')
                        $quantities[4]++;
                    else
                        $quantities[5]++;
                    $flag3 =  true;
                }
                if ($flag1 && $flag2 && $flag3){
                    continue;
                }

            }
        }
        $chart  =	 Charts::create('bar', 'highcharts')
            ->title('Reporte de empleados segun su estado civil')
            ->labels($names)
            ->values($quantities)
            ->dimensions(1000,500)
            ->responsive(false);


        return view('reports.gender',compact('chart'));
    }
}
