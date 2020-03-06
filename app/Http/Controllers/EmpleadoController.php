<?php

namespace App\Http\Controllers;

use App\Empleado;
use App\Feriado;
use App\Http\Controllers\TotalController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use MaddHatter\LaravelFullcalendar\Calendar;
use phpDocumentor\Reflection\Types\Null_;

class EmpleadoController extends Controller
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
    public function index(Request $request)
    {
        if ($request->user()->idRol === 3)
            return redirect(route('user.show',$request->user()->idEmpleado));
        $empleados = Empleado::all();
        return view('welcome')->with('empleados', $empleados);
    }
    public function checkRole(Request $request) {
        dd('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        return view('empleados.show')->with('empleado', $empleado);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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

        $feriados = Feriado::all();
        $fecha = $request->get('fechaInicio');
        $fechaFin = $request->get('fechaFin');
        $empleado = Empleado::find($id);
        $asistencias = $empleado->getAsistencias($fecha, $fechaFin);
        $horarios = $empleado->cargo->horarios;
        $events = [];
        $hours = 0;
        if (isset($empleado->vacaciones[0]))
            $vacacion = $empleado->vacaciones[0];
        else{
            $vacacion = null;
        }
        if ($asistencias->count()) {
            foreach ($asistencias as $key => $value) {
                $fontColor = 'white';
                $carbon = Carbon::createFromDate($key);
                $decimal = number_format((float)$value->sum('horasDeTrabajo'), 1, '.', '');
                $string = $decimal;
                $color = 'blue';
                $decimal < 8 ? $color = "orange" : $color = 'blue';
                if ($feriados->pluck('fecha')->contains($key))
                {
                    $string = 'Feriado 
                        ' . $decimal;
                    $fontColor = 'black';
                    $color = 'cyan';
                }
                else if ( $vacacion != null && $carbon::parse($key)->isBetween($carbon::parse($vacacion->fechaInicio), $carbon::parse($vacacion->fechaFin), true)) {
                    $string = 'Vacacion' . "
                        " . "0.0";
                    $color = 'green';
                    $decimal = 0;
                }
                if ($carbon->dayOfWeek === 0) {
                    $hours = 0;
                    continue;
                }
                else if ($carbon->dayOfWeek === 6)
                {
                    $string = number_format((float)$hours, 1, '.', '');
                    $string < (8 * 5) ? $color = "red" : $color = 'blue';
                }
                if ($carbon->isCurrentDay(Carbon::now()))
                {
                    $sum = 0;
                    foreach ($value as $item)
                    {
                        if (isset($item->horaEntrada) && !isset($item->horaSalida))
                        {
                            $hour = Carbon::parse($item->horaEntrada)->tz('America/La_Paz');
                            $now = Carbon::now()->tz('America/La_Paz');
                            $hours = $now->diffInMinutes($hour,true);
                            $sum += (($hours/60)-4);
                        }
                        else{
                            $sum +=  $item -> horasDeTrabajo;
                        }
                    }

                    $string = number_format($sum,1,'.','');
                }
                $events[] = Calendar::event(
                    $string,
                    true,
                    $key,
                    $key,
                    null,
                    // Add color and link on event
                    [
                        'textColor' => 'white',
                        'color' => $color,
                        'textColor' => $fontColor,
                    ]

                );

                $hours += $decimal;
            }
        }
        $calendar = \Calendar::addEvents($events)
            ->setOptions
            ([ //set fullcalendar options
                'monthNames' => ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio',
                    'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                'dayNames' => ['Domingo', 'Lunes', 'Martes', 'Miercoles',
                    'Jueves', 'Viernes', 'Sabado'],
                'monthNamesShort' => ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun',
                    'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                'dayNamesShort' => ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Total horas'],
                'defaultDate' => $fecha,
                'buttonText' => [
                    'today' => 'Hoy',
                    'day' => 'Dia',
                    'month' => 'Mes',
                    'week' => 'Semana',
                ],
            ]);
        if ($empleado->cargo->flexible == 1) {
            return view('empleados.show')
                ->with('empleado', $empleado)
                ->with('asistencias', $asistencias)
                ->with('calendar',$calendar);
        } else {
            return view('lista')
                ->with('asistencias', $asistencias)
                ->with('empleado', $empleado)
                ->with('calendar', $calendar);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
