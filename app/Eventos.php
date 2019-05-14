<?php
/**
 * Created by IntelliJ IDEA.
 * User: migue
 * Date: 4/4/19
 * Time: 2:38 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;


class Eventos extends Model
{
    protected $table = 'eventos';
    public $timestamps = false;
    public $incrementing=false;
    protected  $primaryKey = 'id_evento';

}

