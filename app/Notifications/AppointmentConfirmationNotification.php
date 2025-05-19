<?php

namespace App\Notifications;

use App\Models\Appointment;
use App\Models\Service;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppointmentConfirmationNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public Appointment $appointment,
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
                'appointment.subject',
                ['service' => $this->appointment->service->name]
            ))
            ->from('noreply@salonbliss.com')
            ->greeting(__(
                'appointment.greeting',
                ['name' => $notifiable->name]
            ))
            ->line(__(
                'appointment.confirmed',
                ['service' => $this->appointment->service->name]
            ))
            ->line(__(
                'appointment.payment',
                ['total' => $this->appointment->total]
            ))
            ->line(__(
                'appointment.code',
                ['code' => $this->appointment->appointment_code]
            ))
            ->line(__(
                'appointment.date',
                ['date' => $this->appointment->date]
            ))
            ->line(__(
                'appointment.time',
                ['start' => $this->appointment->start_time, 'end' => $this->appointment->end_time]
            ))
            ->line(__(
                'appointment.location',
                ['location' => $this->appointment->location->name]
            ))
            ->line(__(
                'appointment.address',
                ['address' => $this->appointment->location->address]
            ))
            ->line(__(
                'appointment.contact',
                ['contact' => $this->appointment->location->telephone_number]
            ))
            ->action(__(
                'appointment.action'
            ), route('dashboard').'?search='. $this->appointment->appointment_code )
            ->line(__(
                'appointment.thanks'
            ));

    }

    public function toArray($notifiable): array
    {
        return [];
    }
}
