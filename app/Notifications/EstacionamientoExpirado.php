<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EstacionamientoExpirado extends Notification
{
    use Queueable;

    protected $usuario;
    protected $estacionamiento;

    public function __construct($usuario, $estacionamiento)
    {
        $this->usuario = $usuario;
        $this->estacionamiento = $estacionamiento;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Tiempo de Estacionamiento Expirado')
            ->greeting('Hola ' . $this->usuario->nombre)
            ->line('Tu tiempo de estacionamiento en el espacio ' . $this->estacionamiento->id . ' ha expirado.')
            ->action('Ver Detalles', url('/estacionamientos/' . $this->estacionamiento->id))
            ->line('Gracias por usar nuestro servicio!');
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
