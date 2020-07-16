<?php

namespace App\Notifications;

use App\Models\Account;
use App\Models\Message;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ManageUserStatus extends Notification
{
    use Queueable;
    /**
     * @var User
     */
    public $user;
    /**
     * @var Account
     */
    public $account;
    /**
     * @var Message
     */
    public $message;

    /**
     * @var
     */
    public $action;

    /**
     * ManageUserStatus constructor.
     * @param User $user
     * @param Account $account
     * @param Message $message
     */
    public function __construct(User $user, Account $account, Message $message, $action = false)
    {
        $this->user = $user;
        $this->account = $account;
        $this->message = $message;
        $this->action = $action;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $subject = sprintf(config('app.name') . $this->message->name);
        $greeting = sprintf('Բարև ' . $this->account->name . " " . $this->account->surname . ', ');
        $mail = (new MailMessage)
            ->subject($subject)
            ->greeting($greeting)
            ->salutation(__("messages.faithfully"))
            ->line($this->message->value)
            ->line(__('messages.thank_you'));
        if ($this->action)
            $mail->action(__('messages.login'), url('/login'));
        return $mail;

    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
