<?php

namespace App\Jobs;

use App\Enums\Disponibility;
use App\Models\Dvd;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class DisponibilityManagementJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public ?Dvd $dvd) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->dvd->update([
            'disponibility' => Disponibility::UNAVAILABLE->value()
        ]);
    }
}
