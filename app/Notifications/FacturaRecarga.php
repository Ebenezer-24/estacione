<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use PDF; 

class FacturaRecarga extends Notification
{
    use Queueable;

    protected $recarga;

    public function __construct($recarga)
    {
        $this->recarga = $recarga;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Factura de Recarga')
            ->greeting('Hola ' . $notifiable->nombre)
            ->line('Has realizado una recarga exitosamente.')
            ->line('Detalles de la transacción:')
            ->line('Comercio: ' . $this->recarga->comercio->razon_social)
            ->line('DNI: ' . $this->recarga->dni)
            ->line('Patente: ' . $this->recarga->patente)
            ->line('Importe: ' . $this->recarga->importe)
            ->line('Fecha: ' . $this->recarga->created_at)
            ->line('Gracias por usar nuestro servicio!')
            ->attachData($this->generateInvoice(), 'factura.pdf', [
                'mime' => 'application/pdf',
            ]);
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }

    protected function generateInvoice()
    {
        $pdf = PDF::loadView('factura', ['recarga' => $this->recarga]);
        return $pdf->output();
    }
}
