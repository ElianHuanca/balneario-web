<?php

namespace App\Http\Controllers;

use App\Exports\ExportTablas;
use App\Models\Activo;
use App\Models\Ambiente;
use App\Models\Persona;
use App\Models\Pagina;
use Illuminate\Http\Request;
use Fpdf\Fpdf;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class ReporteController extends Controller
{
    protected $fpdf;
    protected $defaultModels;
    protected $interfaces;
    protected $atributos;

    public function __construct()
    {
        $this->fpdf = new Fpdf;
        $this->defaultModels = [
            'activo' => Activo::$default,
            'ambiente' => Ambiente::$default,
            'persona' => Persona::$default,
        ];
        $this->interfaces = [
            'activo' => Activo::$interface,
            'ambiente' => Ambiente::$interface,
            'persona' => Persona::$interface,
        ];
        $this->atributos = [
            'activo' => Activo::$atributos,
            'ambiente' => Ambiente::$atributos,
            'persona' => Persona::$atributos,
        ];
    }

    public function index()
    {
        Pagina::contarPagina(\request()->path());
        $modelos = array_keys($this->defaultModels);
        return view('reportes.index', compact('modelos'));
    }

    public function validar(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'modelo' => 'required',
            'extension' => 'required',
        ]);
        if ($request['atributos'] == null) {
            $request['atributos']  =  $this->defaultModels[$request['modelo']];
        }
        return ($request->extension == 'pdf')?
                $this->pdf($request): 
                $this->excel($request);
    }


    public function excel($datos)
    {
        $interface = $this->HeaderModel($datos['modelo'], $datos['atributos']); 
        $export = new ExportTablas($datos, $interface);
        $nombreFile =  $datos['nombre'] . '.' . $datos['extension'];
        return Excel::download($export, $nombreFile);
    }

    public function pdf($datos)
    {
        
        // $empresa = Empresa::first();        
        
        $empresa = [
            'nombre' => 'Canal 11',
            'direccion' => '34',
            'ciudad' => 'Santa cruz de la sierra',
            'telefono' => '72182732',
            'email' => 'canal11@gmail.com',
        ];
        $this->fpdf->AddPage();
        $this->fpdf->SetMargins(10, 10, 10);
        $this->fpdf->SetAutoPageBreak(true, 20);
        $this->setHeader($empresa);

        $this->fpdf->SetFont('Arial', 'B', 13);
        $this->fpdf->Cell(190, 10, utf8_decode($datos['nombre']), 0, 0, 'C');
        $this->fpdf->Ln(15);

        
        $this->fpdf->SetFont('Arial', 'B', 9);
        $this->fpdf->SetFillColor(238, 238, 238);
        $this->fpdf->SetDrawColor(238, 238, 238);
        $this->fpdf->SetTextColor(0, 0, 0);
        
        
        $query = $this->getQueryOrder($datos);
        //header del contenido
        $this->fpdf->SetFont('Arial', 'B', 9);
        $this->fpdf->SetFillColor(238, 238, 238);
        $this->fpdf->SetDrawColor(238, 238, 238);
        $this->fpdf->SetTextColor(0, 0, 0);
        $this->fpdf->Cell(190, 10, utf8_decode(mb_strtoupper('Contenido:', "UTF-8")), 1, 0, 'L', 1);
        $this->fpdf->Ln(15);

        // Datos de la tabla
        $header = $this->HeaderModel($datos['modelo'], $datos['atributos']);
        foreach ($query as $key => $tupla) {

            // if ($datos['modelo'] == "pedidos") {
            //     $this->pedidos($tupla);
            // }
            // if ($datos['modelo'] == "nota_compras") {
            //     $this->compras($tupla);
            // }
            foreach ($datos['atributos'] as $key => $atributo) {
                $this->fpdf->SetFont('Arial', 'B', 9);
                $this->fpdf->Cell(40, 10, utf8_decode(mb_strtoupper($header[$key], "UTF-8") . " :"), 0, 0, 'L', 0);
                $this->fpdf->SetFont('Arial', 'I', 9);
                $this->fpdf->MultiCell(150, 10, utf8_decode($tupla->$atributo), 0, 'L', 0);
            }
            $this->fpdf->SetDrawColor(130, 139, 139);
            $this->fpdf->Line(10, $this->fpdf->GetY() + 5, 200, $this->fpdf->GetY() + 5);
            $this->fpdf->Ln(10);
        }
        $this->fpdf->Output("I", $datos['nombre'] . ".pdf", true);
        header('Location: otra_pag  ina.php');
    }

    public function getQueryOrder($datos)
    {
        if ($datos['filtro'] != null && $datos['buscar'] != null && $datos['order'] != null && $datos['orderBy'] != null && $datos['cantidad'] != null) {

            if ($datos['cantidad'] == 'all') {
                $query = DB::table($datos['modelo'])->where($datos['filtro'], 'like', '%' . $datos['buscar'] . '%')
                    ->orderBy($datos['orderBy'], $datos['order'])
                    ->get();
            } else {
                $query = DB::table($datos['modelo'])->where($datos['filtro'], 'like', '%' . $datos['buscar'] . '%')
                    ->orderBy($datos['orderBy'], $datos['order'])
                    ->paginate($datos['cantidad']);
            }
        } else if ($datos['order'] != null && $datos['orderBy'] != null && $datos['cantidad'] != null) {
            if ($datos['cantidad'] == 'all') {
                $query = DB::table($datos['modelo'])
                    ->orderBy($datos['orderBy'], $datos['order'])
                    ->get();
            } else {
                $query = DB::table($datos['modelo'])
                    ->orderBy($datos['orderBy'], $datos['order'])
                    ->paginate($datos['cantidad']);
            }
        } else if ($datos['filtro'] != null && $datos['buscar'] != null) {
            $query = DB::table($datos['modelo'])->where($datos['filtro'], 'like', '%' . $datos['buscar'] . '%')
                ->orderBy('id', 'asc')
                ->get();
        } else {
            $query = DB::table($datos['modelo'])->get();
        }
        return $query;
    }

    public function HeaderModel($modelo, $atributo)
    {
        $default = $this->atributos[$modelo];
        $interface = $this->interfaces[$modelo];
        foreach ($atributo as $key => $value) {
            //verifica si el value esta en default y devuelve la posicion del array
            $posicion = array_search($value, $default);
            $array[$key] = $interface[$posicion];
        }
        return $array;
    }
    //PDF----------------------------------------------------------------------------
    function setHeader($empresa)
    {
        // Logo
        $this->fpdf->Image('Logo.png', 12, 10, 33);
        // Arial bold 15
        $this->fpdf->SetFont('Arial', 'I', 9);
        // Movernos a la derecha
        $this->fpdf->setX(140);
        // Título
        $this->fpdf->Cell(60, 10, utf8_decode($empresa['nombre'] . ' #: ' . $empresa['direccion']), 0, 0, 'R');
        $this->fpdf->Ln(5);
        $this->fpdf->setX(140);
        $this->fpdf->Cell(60, 10, utf8_decode('Ciudad: ' . $empresa['ciudad']), 0, 0, 'R');
        $this->fpdf->Ln(5);
        $this->fpdf->setX(140);
        $this->fpdf->Cell(60, 10, utf8_decode('Teléfono: ' . $empresa['telefono']), 0, 0, 'R');
        $this->fpdf->Ln(5);
        $this->fpdf->setX(140);
        $this->fpdf->Cell(60, 10, utf8_decode('Correo Electrónico: ' . $empresa['email']), 0, 0, 'R');
        $this->fpdf->Ln(5);
        $this->fpdf->setX(140);
        $this->fpdf->Cell(60, 10, utf8_decode('Creado: ' . now()), 0, 0, 'R');
        // Salto de línea
        $this->fpdf->Ln(15);
    }

    public function getAtributesModel($model)
    {
        if (array_key_exists( $model, $this->defaultModels)) {
            return $this->defaultModels[$model];            
        }  

        return [];
    }

    //-----------------Estadisticas--------------------
    public function estadisticas()
    {
        Pagina::contarPagina(\request()->path());
        $reportes = [
            [
                "id" => 1,
                "descripcion" => "CANTIDAD POR TIPO DE INGRESO DE ACTIVOS QUE INGRESARON EN UNA GESTIÓN",
            ],
            [
                "id" => 2,
                "descripcion" => "TIPOS DE ACTIVOS QUE MAS MANTENIMIENTOS NECESITARON EN UNA GESTIÓN",
            ],
            [
                "id" => 3,
                "descripcion" => "CANTIDAD DE ACTIVOS DAÑADOS POR CADA RESPONSABLE EN UNA GESTION",
            ],
            [
                "id" => 4,
                "descripcion" => "CANTIDAD DE ACTIVOS QUE INGRESARON POR AMBIENTE EN UNA GESTIÓN",
            ],
        ];
        return view('reportes.estadisticas', compact('reportes'));
    }
    
 
    //-----------------------EndPoints-apis------------------------
    public function getTipoReporte($tipoReporte, $year)
    {
        try {
            $query = "";
            switch ($tipoReporte) {
                case 1:
                    $query =  "
                        SELECT t.nombre, COUNT(t.id) as cantidad 
                        FROM activo as a, tipo_ingreso as t
                        WHERE a.id_tipo_ingreso = t.id 
                        AND EXTRACT(YEAR FROM a.fecha_ingreso) = ?
                        group by t.id
                    ";                               
                break;
                
                case 2:
                    $query = "
                        SELECT categoria_activo.nombre, COUNT(categoria_activo.id) as cantidad FROM activo,categoria_activo
                        WHERE activo.id_categoria = categoria_activo.id 
                        AND EXTRACT(YEAR FROM activo.ultimo_mantenimiento) =?
                        group by categoria_activo.id
                    ";                               
                break;
                case 3:
                    $query =  "
                        SELECT persona.nombre, COUNT(persona.id) as cantidad 
                        FROM activo ,persona,ambiente
                        WHERE activo.id_ambiente = ambiente.id AND ambiente.id_persona = persona.id
                        AND EXTRACT(YEAR FROM activo.ultimo_mantenimiento) =?
                        group by persona.id
                    ";                               
                break;

                case 4:
                    $query =  "
                        SELECT ambiente.nombre, COUNT(ambiente.id) as cantidad 
                        FROM activo ,ambiente
                        WHERE activo.id_ambiente = ambiente.id
                        AND EXTRACT(YEAR FROM activo.fecha_ingreso) =?
                        group by ambiente.id
                    ";                               
                break;
            }
            $results = DB::select($query, [$year]);
            $leng = count($results);
            $resultado = ["data" => ""];
            if ($leng > 0) {
                $cantidad = 0;
                foreach ($results as $res) {
                 $cantidad = $cantidad + $res->cantidad;
                }
                $r = 'https://chart.apis.google.com/chart?chs=700x300&cht=p&chd=t:';
                $cabecera = "";
                $porcentaje = "";
                foreach ($results as $res) {
                    $f = ((double)$res->cantidad)*100 / $cantidad;
                    $f = (string) round($f, 2);
                    $porcentaje = $porcentaje . $f  . ",";
                    $cabecera = $cabecera . $f ."%-". $res->nombre . "|";
                }
                $cabecera = substr($cabecera, 0, -1);
                $porcentaje = substr($porcentaje, 0, -1);
                $r = $r . $porcentaje . "&chl=" .$cabecera;
                $resultado = ["data" => $r];
            }
             return $resultado;    
        } catch (\Throwable $th) {
            return ["error" =>  "0"];
        }
    }
}
