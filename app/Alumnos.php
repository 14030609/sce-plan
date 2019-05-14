<?php
/**
 * Created by IntelliJ IDEA.
 * User: migue
 * Date: 4/4/19
 * Time: 10:23 AM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;


class Alumnos extends Model
{
    protected $table = 'alumnos';
    public $timestamps = false;
    public $incrementing=false;
    protected  $primaryKey = 'nua';

}

