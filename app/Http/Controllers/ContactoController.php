<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller
{
    /**
     * Mostrar formulario de contacto
     */
    public function index()
    {
        return view('contacto');
    }

    /**
     * Procesar formulario de contacto
     */
    public function enviar(Request $request)
    {
        $validated = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'asunto' => ['required', 'string', 'max:255'],
            'mensaje' => ['required', 'string', 'min:10', 'max:2000'],
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Introduce un correo electrónico válido.',
            'asunto.required' => 'Por favor, selecciona un asunto.',
            'mensaje.required' => 'El mensaje es obligatorio.',
            'mensaje.min' => 'El mensaje debe tener al menos 10 caracteres.',
            'mensaje.max' => 'El mensaje no puede exceder 2000 caracteres.',
        ]);

        // Registrar el mensaje en los logs
        // En producción, aquí podrías enviar un email real
        Log::info('Nuevo mensaje de contacto recibido', [
            'nombre' => $validated['nombre'],
            'email' => $validated['email'],
            'asunto' => $validated['asunto'],
            'mensaje' => $validated['mensaje'],
            'fecha' => now(),
        ]);

        // Opcional: Enviar email
        // Descomenta esto cuando configures el email en .env
        /*
        try {
            Mail::send('emails.contacto', $validated, function($message) use ($validated) {
                $message->to('tu-email@ejemplo.com')
                        ->subject('Nuevo mensaje de contacto: ' . $validated['asunto'])
                        ->replyTo($validated['email'], $validated['nombre']);
            });
        } catch (\Exception $e) {
            Log::error('Error al enviar email de contacto: ' . $e->getMessage());
        }
        */

        return back()->with('success', '¡Gracias por tu mensaje! Te responderemos pronto.');
    }
}