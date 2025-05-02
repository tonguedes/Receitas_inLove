<?php

// app/Notifications/ReceitaStatusNotification.php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ReceitaStatusNotification extends Notification
{
    use Queueable;

    protected $status;
    protected $titulo;

    public function __construct($status, $titulo)
    {
        $this->status = $status;
        $this->titulo = $titulo;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $mensagem = $this->status === 'aprovada'
            ? 'Sua receita foi aprovada e já está visível no site!'
            : 'Sua receita foi rejeitada. Você pode revisar e tentar novamente.';

        return (new MailMessage)
                    ->subject("Sua receita \"{$this->titulo}\" foi {$this->status}")
                    ->greeting("Olá, {$notifiable->name}")
                    ->line($mensagem)
                    ->action('Ver minhas receitas', url('/dashboard')) // ou o link que preferir
                    ->line('Obrigado por contribuir com o site!');
    }
}
