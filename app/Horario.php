<?php
/**
 * Created by IntelliJ IDEA.
 * User: migue
 * Date: 4/5/19
 * Time: 11:49 AM
 */

namespace App;



use Illuminate\Database\Eloquent\Model;


class Horario extends Model
{
//    use HasCompositePrimaryKey;

    protected $table = 'horario';
    public $timestamps = false;
    public $incrementing=false;
//      protected  $primaryKey = ['id_dia','cvemat'];
  //  protected $primaryKey = array('id_dia','cvemat');
      protected  $primaryKey = 'id_dia';
}

