<?php

namespace App\Notifications;

use App\Utils\NotificationUtil;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SupplierNotification extends Notification
{
    use Queueable;

    protected $notificationInfo;

    protected $cc;

    protected $bcc;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($notificationInfo)
    {
        $this->notificationInfo = $notificationInfo;

        $notificationUtil = new NotificationUtil;
        $notificationUtil->configureEmail($notificationInfo);
        $this->cc = ! empty($notificationInfo['cc']) ? $notificationInfo['cc'] : null;
        $this->bcc = ! empty($notificationInfo['bcc']) ? $notificationInfo['bcc'] : null;
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
        $data = $this->notificationInfo;
        $mail = (new MailMessage)
            ->subject($data['subject'])
            ->view(
                'emails.plain_html',
                ['content' => $data['email_body']]
            );
        if (! empty($this->cc)) {
            $mail->cc($this->cc);
        }
        if (! empty($this->bcc)) {
            $mail->bcc($this->bcc);
        }

        return $mail;
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
