<?php

namespace Tests\Feature\Negative;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Artisan;
use Laravel\Sanctum\Sanctum;
use Laravel\Socialite\Facades\Socialite;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseMigrations;
    protected $headers = [
        'Accept' => 'application/json'
    ];

    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
    }
    public function testLogout()
    {
        $response = $this->get('/api/logout' , $this->headers);
        $response->assertStatus(401); // redirect
    }

    public function testGetCurrentUser()
    {
        $response = $this->get('/api/current' , $this->headers);
        $response->assertStatus(401);
    }

    public function testGetUsers()
    {
        $response = $this->get('/api/users' , $this->headers);
        $response->assertStatus(401);
    }
}
