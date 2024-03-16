<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class BlogController extends Controller
{
    public function cargarDatos()
    {
        $client = new Client();

        $response = $client->request('GET', env('URL_API'));

        if ($response->getStatusCode() == 200) {
            $videos = json_decode($response->getBody(), true);
            return view('blog', compact('videos'));
        } else {
            return redirect()->back()->with('error', 'Error al obtener los datos de la API.');
        }
    }

    public function guardar(Request $request)
{
    $client = new Client();

    $imagenData = null;

    try {
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $imagenData = $imagen->get();
        }
    } catch (\Exception $ex) {
    }

    $datos = [
        'titulo' => $request->input('titulo'),
        'descripcion' => $request->input('descripcion'),
        'autor' => $request->input('autor'),
        'url_recurso' => $request->input('url_recurso'),
        'imagen'=> $imagenData
    ];

    try {
        $response = $client->request('POST', env('URL_API'), [
            'form_params' => $datos,
        ]);

        $statusCode = $response->getStatusCode();
        $content = $response->getBody()->getContents();

        if ($statusCode == 200) {
            return response()->json([
                'success' => true,
                'message' => 'Video guardado exitosamente.',
                'data' => json_decode($content),
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Error al guardar el video.',
            ], $statusCode);
        }
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error en la solicitud HTTP: ' . $e->getMessage(),
        ], 500);
    }

    
}
}
