<?php

namespace App\Notifications;

use App\Models\Service;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewServiceReleasedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public Service $service,
    )
    {
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject(__(
                'new_service.subject',
                ['service' => $this->service->name]
            ))
            ->from('info@salonbliss.com')
            ->greeting(__(
                'new_service.greeting',
                ['name' => $notifiable->name]
            ))
            ->line(__(
                'new_service.headline'
            ))
            ->line(__(
                'new_service.intro',
                ['service' => $this->service->name]
            ))
            ->line(__(
                'new_service.price',
                ['price' => number_format($this->service->price, 2, ',', '.')]
            ))
            ->line(__(
                'new_service.benefits',
                ['benefits' => $this->service->benefits]
            ))
            ->action(__(
                'new_service.action'
            ), url('/services/' . $this->service->slug))
            ->line(__(
                'new_service.thanks'
            ));
    }

    public function toArray($notifiable): array
    {
        return [];
    }
}
