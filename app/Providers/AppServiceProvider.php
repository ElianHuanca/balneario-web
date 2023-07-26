<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use View;
use App\Models\Modulo;
use App\Models\Permiso;
use App\Models\Rol;
use App\Models\Accion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        /*
            'SELECT nombre,param FROM accion AS a WHERE a.id=\'1' . $codMod . '\'';
             SELECT nombre FROM accion AS a WHERE a.id_modulo = 1;
        */


        /*
            try {
                $sql = 'SELECT mg.mod_cod,mod_name,mod_file
                        FROM mod_grup AS mg,modulo AS m
                        WHERE mg.grup_cod=\'' . $grup_cod . '\' AND mg.mod_cod=m.mod_cod;';
                $rs = $this->conexion->prepare($sql);
                $rs->execute();
                return  $rs->fetchAll();
            } catch (\Throwable $th) {
                $th->getMessage();
            }



            $menu = array();
            for ($i = 0; $i < count($mod); $i++) {
            /Buscar Modulos Habilitados para el Usuario/
                $codMod = $mod[$i]['mod_cod'];
                $sql = 'SELECT acc_name,acc_param FROM accion AS a WHERE a.mod_cod=\'' . $codMod . '\'';
                $rs  = $this->conexion->prepare($sql);
                $rs->execute();
                $acc = $rs->fetchAll();
                $subMenu = array();
                for ($j = 0; $j < count($acc); $j++) {
                    //   $link=chop(trim ($mod[$i]['mod_file']).'?'.trim($acc[$j]['acc_param']),'');
                    $subMenu[$j] = array('name' => $acc[$j]['acc_name'], 'param' => $acc[$j]['acc_param']);
                }
                $menu[$i] = array('name' => $mod[$i]['mod_name'], 'file' => $mod[$i]['mod_file'], 'subMenu' => $subMenu);
            }
            $_SESSION['menu'] = $menu;
        */


        View::composer('*', function ($view) {
            //todo filtrar navbars por rol
            //$navbars = Modulo::all();
            /* $user = Auth::user();
            $roles = DB::table('permiso')
                ->where('id_user', $user->id)
                ->where('usuario', $user->name)->get(); */


            /* $navbars = DB::table('modulo')
                ->join('modulo_rol as mr', 'mr.id_rol', '=', $roles->first()->id)
                ->join('modulo_rol as mr', 'mr.id_modulo', '=', 'modulo.id')->get();
            $view->with('navbars', $navbars); */
        });


        /* $user = Auth()->user->id;

        $res = $this->conexion->prepare("SELECT * FROM permiso WHERE per_cod='$user' AND perm_pass='$pass';");
        $res->execute();
        $perm = $res->fetchAll();
            if (count($perm) >= 1) // Es una persona de la agenda
            {
                switch ($perm[0]['grup_cod']) {
                    case 1: {
                            return 1; //USUARIO AMIGO;
                        };
                        break;
                    case 2: {
                            return 2; //USUARIO PROPIETARIO;
                        };
                        break;
                    default: {
                            return -999; //OTRO TIPO ;
                        };
                        break;
                }
            } else {
                //echo "tu eres un usuario NO VALIDO";
                return -1; //USUARIO NO VALIDO
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        } */
    }
}
