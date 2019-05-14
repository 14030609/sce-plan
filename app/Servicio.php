<?php

namespace App;
use Illuminate\Database\Eloquent\Model;


class Servicio extends Model
{
protected $table = 'serviciosocial';
public $timestamps = false;
public $incrementing=false;
protected  $primaryKey = 'id_servicio';

}
