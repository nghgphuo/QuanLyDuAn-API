<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\NewAccountNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Throwable;

class SendEmail implements ShouldQueue 
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;
    public $backoff = 10;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $user;
    protected $password;
    protected $resetUrl;
    public function __construct(User $user, string $password, string $resetUrl)
    {
        $this->user = $user;
        $this->password = $password;
        $this->resetUrl = $resetUrl;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $this->user->notify(new NewAccountNotification(
                $this->user,
                $this->password,
                $this->resetUrl
            ));
             Log::info("Thông tin tài khoản đã được gửi tới: {$this->user->email}");
        } catch (Throwable $e) {
            Log::warning("Lần thử gửi email thất bại cho {$this->user->email}: " . $e->getMessage());
            throw $e;
        }
    }

    public function failed(Throwable $exception)
    {
        Log::error("Job gửi email thất bại hoàn toàn cho {$this->user->email}: " . $exception->getMessage());
    }
}
