<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    protected $table = 'Asistencia';
    protected $primaryKey = 'idAsistencia';
    protected $fillable = [
        'idAsistencia','fecha','horaEntrada','horaSalida','horasDeTrabajo','idEmpleado'
    ];
    public $timestamps = false;

    public function getHoursOfWork(){

    }

    public function stringFecha(){
        $date = Carbon::createFromDate($this->fecha);
        return $date->formatLocalized('%A %d %B %Y');
    }
    public function empleado()
    {
        return $this->belongsTo('App\Empleado','idEmpleado','idEmpleado');
    }

}
