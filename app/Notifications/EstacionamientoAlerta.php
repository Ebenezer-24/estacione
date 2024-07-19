<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EstacionamientoAlerta extends Notification
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
            ->subject('Alerta de Estacionamiento')
            ->greeting('Hola ' . $this->usuario->nombre)
            ->line('Faltan 15 minutos para que termine tu tiempo de estacionamiento en el espacio ' . $this->estacionamiento->id)
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
