<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;
use App\Models\Book;

class notifyDeactiveVault extends Notification
{
    use Queueable;
    private $book;
    private $user;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Book $book, User $user)
    {
        $this->user=$user;
        $this->book=$book;
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
                    ->line('Olá '.$this->user->name.'!')
                    ->line('A função cofre foi desativada para o caderno '.$this->book->title.' com sucesso!')
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
            'descriptionNotify'=>'Função cofre foi desativada para o caderno '.$this->book->title.'. Do usuário: '.$this->user->name,
        ];
    }
}
