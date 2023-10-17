<?php

namespace App\Jobs;

use App\Models\Product;
use App\Notifications\SendProductCreatedNotification;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class NotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $product;
    public function __construct($product)
    {
        $this->product = $product;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        try {
            $emailAddress = config('products.email');
            // Отправляем уведомление о создании продукта
            Notification::route('mail', $emailAddress)->notify(new SendProductCreatedNotification($this->product));
        } catch (Exception $e) {
            Log::error('Ошибка при выполнении задачи NotificationJob: ' . $e->getMessage());
        }
    }


}
