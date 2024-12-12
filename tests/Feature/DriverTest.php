<?php

namespace Tests\Feature;

use App\Models\Driver;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Job;
use Tests\TestCase;

class DriverTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_driver_can_update_job_status()
    {
        // Létrehozunk egy fuvarozót a drivers táblában és egy munkát hozzárendelve
        $driver = Driver::factory()->create(['is_admin' => 0]);
        $job = Job::factory()->create(['driver_id' => $driver->id, 'status' => 'Assigned']);

        // Bejelentkezünk a fuvarozóként
        $this->actingAs($driver, 'driver');

        // Teszteljük a PUT kérést a munka státuszának frissítésére
        $response = $this->put(route('drivers.update', $job->id), [
            'status' => 'completed',
        ]);

        // Ellenőrizzük, hogy a válasz redirect és a státusz frissült
        $response->assertRedirect(route('drivers.index'));
        $this->assertDatabaseHas('jobs', [
            'id' => $job->id,
            'status' => 'completed',
        ]);
    }
}
