<?php
/**
 * Created by IntelliJ IDEA.
 * User: migue
 * Date: 4/4/19
 * Time: 1:40 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;


class Kardex extends Model
{
    protected $table = 'kardex';
    public $timestamps = false;
    public $incrementing=false;
    protected  $primaryKey = 'cvemat';

}

