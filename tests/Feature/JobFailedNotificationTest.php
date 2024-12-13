<?php

namespace Tests\Feature;

use App\Mail\JobFailedNotification;
use App\Models\Driver;
use App\Models\Job;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class JobFailedNotificationTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_failed_job_sends_email()
    {
        Mail::fake();

        // Admin felhasználó létrehozása
        $admin = Driver::factory()->create([
            'is_admin' => true,
        ]);

        // admin felhasználót bejelentkeztetése
        $this->actingAs($admin, 'driver');

        // teszt munka rekord
        $job = Job::factory()->create([
            'status' => 'Assigned', // Az alap státusz
        ]);

        $response = $this->patch(route('jobs.update', $job->id), [
            'status' => 'failed', // Frissített státusz
            'starting_address' => $job->starting_address,
            'destination_address' => $job->destination_address,
            'recipient_name' => $job->recipient_name,
            'recipient_phone' => $job->recipient_phone,
            'driver_id' => $job->driver_id,
        ]);
    
        // Ellenőrizzük, hogy az e-mail el lett küldve
        Mail::assertSent(JobFailedNotification::class, function ($mail) use ($job) {
            return $mail->job->id === $job->id;
        });

        // Sikeres a válasz
        $response->assertRedirect(route('jobs.index'));
    }
}
