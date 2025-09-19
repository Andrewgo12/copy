<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Respuesta exitosa estándar
     */
    protected function success($data = [], $message = 'Operación exitosa', $statusCode = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ], $statusCode);
    }

    /**
     * Respuesta de error estándar
     */
    protected function error($message = 'Error interno', $statusCode = 500, $errors = null)
    {
        $response = [
            'success' => false,
            'message' => $message,
            'error' => true
        ];

        if ($errors) {
            $response['errors'] = $errors;
        }

        return response()->json($response, $statusCode);
    }

    /**
     * Validar parámetros requeridos
     */
    protected function validateRequired(Request $request, array $fields)
    {
        $missing = [];
        
        foreach ($fields as $field) {
            if (!$request->has($field) || empty($request->input($field))) {
                $missing[] = $field;
            }
        }
        
        return $missing;
    }
}