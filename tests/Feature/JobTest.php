<?php

namespace Tests\Feature;

use App\Models\Driver;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class JobTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function an_admin_can_create_a_job()
    {
        // Admin felhasználó létrehozása
        $admin = Driver::factory()->create(['is_admin' => 1]);

        // Bejelentkezünk az adminnal
        $this->actingAs($admin, 'driver');

        // Teszteljük a POST kérést a munka létrehozásához
        $response = $this->post(route('jobs.store'), [
            'starting_address' => 'Start Address',
            'destination_address' => 'Destination Address',
            'recipient_name' => 'Recipient Name',
            'recipient_phone' => '1234567890',
            'status' => 'Assigned',
            'driver_id' => $admin->id,
        ]);

        // Ellenőrizzük, hogy a válasz redirect és az adatbázisban megjelent az új munka
        $response->assertRedirect(route('jobs.index'));
        $this->assertDatabaseHas('jobs', [
            'starting_address' => 'Start Address',
            'destination_address' => 'Destination Address',
            'recipient_name' => 'Recipient Name',
        ]);
    }
}
