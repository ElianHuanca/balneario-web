<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportTablas implements FromCollection, WithHeadings

{
    protected $query;
    protected $encabezado;

    public function headings(): array
    {
        return $this->encabezado;
    }

    public function __construct($datos, $encabezado)
    {
        $this->encabezado = $encabezado;
        //$this->query = $invoices;
        if ($datos['filtro'] != null && $datos['buscar'] != null && $datos['order'] != null && $datos['orderBy'] != null && $datos['cantidad'] != null) {

            if ($datos['cantidad'] == 'all') {
                $this->query = DB::table($datos['modelo'])->where($datos['filtro'], 'like', '%' . $datos['buscar'] . '%')
                    ->select($datos['atributos'])
                    ->orderBy($datos['orderBy'], $datos['order'])
                    ->get();
            } else {
                $this->query = DB::table($datos['modelo'])->where($datos['filtro'], 'like', '%' . $datos['buscar'] . '%')
                    ->select($datos['atributos'])
                    ->orderBy($datos['orderBy'], $datos['order'])
                    ->paginate($datos['cantidad']);
            }
        } else if ($datos['order'] != null && $datos['orderBy'] != null && $datos['cantidad'] != null) {
            if ($datos['cantidad'] == 'all') {
                $this->query = DB::table($datos['modelo'])
                    ->select($datos['atributos'])
                    ->orderBy($datos['orderBy'], $datos['order'])
                    ->get();
            } else {
                $this->query = DB::table($datos['modelo'])
                    ->select($datos['atributos'])
                    ->orderBy($datos['orderBy'], $datos['order'])
                    ->paginate($datos['cantidad']);
            }
        } else {
            $this->query = DB::table($datos['modelo'])->select($datos['atributos'])->get();
        }
    }

    public function collection()
    {
        return $this->query;
    }
}

