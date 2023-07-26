<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fotografia;
use Illuminate\Support\Facades\DB;
use App\Models\Ambiente;
use App\Models\Activo;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class FotografiaController extends Controller
{
    //tipotabla 1 si es ambiente, 2 si es activo
    public function saveFotos($foto, $id, $tipoTabla)
    {
        //get filename with extension
        $filenamewithextension = $foto->getClientOriginalName();

        //get filename without extension
        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

        //get file extension
        $extension = $foto->getClientOriginalExtension();
        
        //filename to store
        $filenametostore = $filename . '_' . uniqid() . '.' . $extension;

        //Upload File to external server
        Storage::disk('ftp')->put($this->getPathBase($tipoTabla, 1) . $filenametostore, fopen($foto, 'r+'));
        
        //Store in the database
        //get urlBase to store image
        $base = $this->getUrlBase($tipoTabla, 1);

        $fotografia = new Fotografia();
        $fotografia->timestamps = false;
        $fotografia->url = $base. $filenametostore;
        $fotografia->fecha = now();
        $fotografia->id_tabla = $id;
        $fotografia->tipo_tabla = $tipoTabla;
        $fotografia->save();
    }

    public function generateQr($id, $tipoTabla)
    {
        $url = env('SERVICE','http://miempresa.fun/juan/Canal11-WEB/public');
        $image = null;
        if($tipoTabla == 1){
            $image = \QrCode::format('svg')
            ->size(200)->errorCorrection('H')
            ->generate("Informacion del ambiente: \n
                        $url/ambientes/$id");
        }else{
            $image = \QrCode::format('svg')
            ->size(200)->errorCorrection('H')
            ->generate("Informacion del activo: \n
                        $url/activos/$id");
        }

        $output_file = 'qr-' . time() . '.svg';
        Storage::disk('ftp')->put($this->getPathBase($tipoTabla, 2). $output_file, $image);

        $fotografia = new Fotografia();
        $fotografia->timestamps = false;
        $fotografia->url = $this->getUrlBase($tipoTabla, 2) . $output_file;
        $fotografia->fecha = now();
        $fotografia->id_tabla = $id;
        $fotografia->tipo_tabla = $tipoTabla;
        $fotografia->save();
    }

    public function destroy($id){
        Fotografia::destroy($id);
        return redirect()->back()->with('success', 'your message,here'); 
    }

    // tipo tabla: 1 si es un ambiente, 2 si es activo
    // tipo foto: 1 si es una foto de activo o ambiente, !1 si es un qr
    public function getUrlBase($tipoTabla, $tipoFoto){
        $urlBase = 'http://miempresa.fun/juan/S3-CANAL11/';
        if($tipoTabla == 1){
            $urlBase = $urlBase.'AMBIENTES/';
        }else{
            $urlBase = $urlBase.'ACTIVOS/';
        }

        if($tipoFoto !== 1){ //entra cuando es un qr
            $urlBase = $urlBase.'QR/';
        }

        return $urlBase;
    }

    public function getPathBase($tipoTabla, $tipoFoto){
        $urlBase = 'S3-CANAL11/';
        if($tipoTabla == 1){
            $urlBase = $urlBase.'AMBIENTES/';
        }else{
            $urlBase = $urlBase.'ACTIVOS/';
        }

        if($tipoFoto !== 1){ //entra cuando es un qr
            $urlBase = $urlBase.'QR/';
        }

        return $urlBase;
    }
}