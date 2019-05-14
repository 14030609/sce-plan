<?php

namespace App;
use App\Usuarios;
use Illuminate\Support\Facades\Session;

use DB;


class Sce
{

    function __construct()
    {
        # code...
    }
    /*********************************************************************************************
     * metodo que obtner los datos de la base de datos y ponerlos en un arreglo
     * @param $table String nombre de la tabla de la cual se quiere obtner los datos
     *@return $datos array() obtiene los datos de la tabla
     **********************************************************************************************/
    function obtener_query($table=null)
    {
        if (!empty($table))
        {
            $this->conexion();
            $datos =[];
            foreach ($this->db->query($table, PDO::FETCH_ASSOC) as $fila) {
                array_push($datos,$fila);
            }
            return $datos;
        }else
            die ("Es necesario definir ls consulta ");
    }
    /*************************************************************************************
     * Metodo que recibe un arreglo asociativo de NxN y retorne una variable con el HTML y los datos
    necesarios para generar una tabla
     * @param $arreglo array() arreglo asociativo con los valoes
     *************************************************************************************/
    function arregloTabla($arreglo)
    {
        //	$id;
        $cont=0;
        $size=sizeof($arreglo);
        echo "<table class='table'>";
        echo "<thead class='thead-dark'>";
        echo "<tr>";
        //	$id;
        $bandera = true;
        $keys=array_keys($arreglo[0]);
        foreach ($keys as $key => $value) {
            echo "<th>".$value."</th>";
            if($bandera)
            {
                $id=$value;
                $bandera=false;
            }
        }
        echo "</tr>";

        foreach ($arreglo as $key => $valor) {
            echo "<tr>";
            foreach ($valor as $key => $value) {
                echo "<td>".$value."</td>";
            }
            echo "<td><a href='eliminar.php?id=$valor[$id] '><img src='../../images/equis.png'/></a></td>";
            echo "<td><a href='editar.php?id=$valor[$id] '><img src='../../images/Lapiz.png'/></a></td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    }


    /*************************************************************************************
     * Metodo que recibe un arreglo asociativo de NxN y retorne una variable con el HTML y los datos necesarios para generar una tabla
     * @param $arreglo array() arreglo asociativo con los valoes
     *************************************************************************************/
    function credenciales  ($email)
    {
        $sql1 ="SELECT   DISTINCT u.email, p.id_permiso, p.permiso, r.id_rol, r.rol from usuarios u inner join usuarios_rol ur on u.email= ur.email inner join rol r on r.id_rol= ur.id_rol inner join rol_permiso rp on rp.id_rol= r.id_rol inner join permisos p on p.id_permiso= rp.id_permiso
				where u.email= '$email' ";

        $array1 =DB::SELECT($sql1);
        $rol=array ();
        $permiso=array ();

        foreach ($array1 as $key => $value) {
            array_push($rol,$value->rol );
            array_push($permiso,$value->permiso);
        }
        $datos=array ( 'rol'=> array_unique($rol),
            'permiso'=> array_unique($permiso));
        return $datos;
    }

    function login ($email, $contrasena)
    {
        session_start();

        //	$contrasena=md5($contrasena);
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $sql="SELECT * FROM usuarios WHERE email='$email' and contrasenia = '$contrasena'";

            $payment =DB::SELECT($sql);

            if (sizeof($payment)>0) {

                $payment=$payment[0];

                Session::put('validado',true);
                Session::put('usuario',$payment->email);


                $_SESSION['validado']=true;
                $_SESSION['usuario']=$payment->email;

                $credenciales =$this->credenciales($email);
                $_SESSION['credenciales']=$credenciales;

                Session::put('credenciales',$credenciales);

            }else
            {
                //print_r($usuario);
                die('el usuario o contraseña es incorrecto :P');
            }

        }else
        {
            die('El emial es incorrecto');

        }
    }

    function Logout ()
    {
        session_destroy();
//			header('Location: ../../index.html');

    }
    function checarRol($rol)
    {

        if (isset($_SESSION ['validado'])) {
            if ($_SESSION['validado']) {
                $roles= $_SESSION['credenciales']['rol'];
                if (!in_array($rol,$roles)) {
                    die('el usuario no tiene un rol permitido');
                }
            }else
            {
                die('usuario no valido');
            }
        }else
        {
            die('usuario no valido');
        }
    }
    function checarPermiso($permiso)
    {
        if (isset($_SESSION['validado'])) {
            if ($_SESSION['validado']) {
                $permisos= $_SESSION['credenciales']['permiso'];
                if (!in_array($permiso,$permisos)) {
                    die('el usuario no tiene un permiso permitido');
                }
            }else
            {
                die('usuario no valido');
            }
        }else
        {
            die('usuario no valido');
        }
    }
    function validarRol($rol)
    {
        if (isset($_SESSION['validado'])) {
            if ($_SESSION['validado']) {
                $roles= $_SESSION['credenciales']['rol'];
                if (!in_array($rol,$roles)) {
                    return false;
                }
            }else
            {
                return false;
            }
        }else
        {
            return false;
        }

        return true;
    }
    function validarPermiso($permiso)
    {
        if (isset($_SESSION['validado'])) {
            if ($_SESSION['validado']) {
                $permisos= $_SESSION['credenciales']['permiso'];
                if (!in_array($permiso,$permisos)) {
                    return false;
                }
            }else
            {
                return false;
            }
        }else
        {
            return false;
        }
        return true;
    }
}
