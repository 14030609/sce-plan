<?php
/**
 * Created by IntelliJ IDEA.
 * User: migue
 * Date: 4/4/19
 * Time: 11:46 AM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;


class Reticula extends Model
{
    protected $table = 'reticula';
    public $timestamps = false;
    public $incrementing=false;
    protected $primaryKey  = 'cveesp';

}

