<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    public $token;
    /**
     * Create a notification instance.
     *
     * @param  string  $token
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
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
                    ->from('noreply@moghadamprint.com')->subject('بازیابی رمز عبور-مجتمع تبلیغاتی مقدم چاپ')
                    ->line('برای بازیابی رمز عبور خود روی لینک زیر کلیلک کنید . درصورتی که شما چنین درخواستی نداده اید این ایمیل را نادیده بگیرید')
                    ->action('بازیابی رمز عبور',url(config('app.url').route('password.reset', $this->token, false)))
                    ->line('این ایمیل تا 24 ساعت پس از ارسال معتبر می باشد.');
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
            //
        ];
    }
}
