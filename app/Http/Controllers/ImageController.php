<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class ImageController extends Controller
{
    public function show($path)
    {
        // Vérifier si le fichier existe
        if (!Storage::disk('public')->exists($path)) {
            abort(404);
        }

        // Récupérer le fichier
        $file = Storage::disk('public')->get($path);
        $type = Storage::disk('public')->mimeType($path);

        // Retourner la réponse avec les bons headers
        return Response::make($file, 200, [
            'Content-Type' => $type,
            'Content-Disposition' => 'inline; filename="' . basename($path) . '"',
            'Cache-Control' => 'public, max-age=31536000',
        ]);
    }
} 