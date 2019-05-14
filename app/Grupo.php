<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Grupo extends Model {
    protected $table = 'grupo';
    public $timestamps = false;
    public $incrementing=false;
    protected  $primaryKey = 'id_grupo';

}