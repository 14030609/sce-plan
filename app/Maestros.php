<?php
/**
 * Created by IntelliJ IDEA.
 * User: migue
 * Date: 4/4/19
 * Time: 1:00 PM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;


class Maestros extends Model
{
    protected $table = 'maestros';
    public $timestamps = false;
    public $incrementing=false;
    protected  $primaryKey = 'cvemae';

}

