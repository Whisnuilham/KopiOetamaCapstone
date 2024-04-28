<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Notification;

class IngredientsExpiredNotification extends Notification
{
    use Queueable;

    protected $ingredient_stock;

    /**
     * Create a new notification instance.
     *
     * @param  \App\Models\IngredientStock  $ingredient_stock
     * @return void
     */
    public function __construct(\App\Models\IngredientStock $ingredient_stock)
    {
        $this->ingredient_stock = $ingredient_stock;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }


    /**
     * Get the database representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        $message = 'Your ingredient "' . $this->ingredient_stock->ingredient->ingredient_name . '" is expiring in 5 days.';
        
        return [
            'message' => $message,
            'ingredient_name' => optional($this->ingredient_stock->ingredient)->ingredient_name ?? 'Unknown',
            'expiration_date' => $this->ingredient_stock->expired_date ?? 'Unknown',
            'ingredient_in_stock' => $this->ingredient_stock->in_stock ?? 0,
            'ingredient_out_stock' => $this->ingredient_stock->out_stock ?? 0,
            'notification_type' => static::class,
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    /* public function toArray(object $notifiable): array
    {
        return [
        ];
    } */
}
