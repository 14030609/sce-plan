<?php
/**
 * Created by IntelliJ IDEA.
 * User: migue
 * Date: 4/4/19
 * Time: 8:02 AM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;


class Usuarios extends Model
{
    protected $table = 'usuarios';
    public $timestamps = false;
    public $incrementing=false;
    protected  $primaryKey = 'email';

}

