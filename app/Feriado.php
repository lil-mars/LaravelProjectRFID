<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class Feriado extends Model
{
    protected $primaryKey = 'idFeriado';
    protected $table = 'Feriado';
    protected $fillable = [
      'idFeriado','fecha','nombre'
    ];

}
