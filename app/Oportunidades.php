<?php
/**
 * Created by IntelliJ IDEA.
 * User: migue
 * Date: 4/4/19
 * Time: 8:34 AM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;


class Oportunidades extends Model
{
    protected $table = 'oportunidad';
    public $timestamps = false;
    public $incrementing=false;
    protected  $primaryKey = 'oportunidad';

}

