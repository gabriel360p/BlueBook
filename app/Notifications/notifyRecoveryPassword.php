<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class notifyRecoveryPassword extends Notification
{
    use Queueable;
    private $usuario;
    private $codigo;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($usuario,$codigo)
    {
        $this->usuario=$usuario;
        $this->codigo=$codigo;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->greeting('BlueBook')
                    ->line('Olá '.$this->usuario->name.'!')
                    ->line('Código de recuperação de senha: '.$this->codigo)
                    ->line('Obrigado por escolher BlueBook!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'descriptionNotify'=>,
        ];
    }
}
