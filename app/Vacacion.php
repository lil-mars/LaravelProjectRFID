<?php


namespace App;



use Illuminate\Database\Eloquent\Model;

class Vacacion extends Model
{
    protected $primaryKey = 'idVacacion';
    protected $table = 'Vacacion';
    protected $fillable = [
      'idVacacion','idEmpleado','fechaInicio','fechaFin','totalDias'
    ];

    public function empleado()
    {
        return $this->belongsTo('App\Empleado','idEmpleado','idEmpleado');
    }
}
