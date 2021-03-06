<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Artisan;
use Laravel\Sanctum\Sanctum;
use Laravel\Socialite\Facades\Socialite;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * @var string[]
     */
    private $socialLoginRedirects;

    public function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        Artisan::call('db:seed --class=DatabaseSeeder');
        $this->socialLoginRedirects = [
            'facebook' => 'https://www.facebook.com/v3.0/dialog/oauth',
            'google'   => 'https://accounts.google.com/o/oauth2/auth',
            'github'   => 'https://github.com/login/oauth/authorize',
            'twitter'  => 'https://api.twitter.com/oauth/authenticate'
        ];
    }

    public function testLogin()
    {
        $providerMock = \Mockery::mock('Laravel\Socialite\Contracts\Provider');
        $providerMock->shouldReceive('redirect')->andReturn(new
        RedirectResponse($this->socialLoginRedirects['google']));
        Socialite::shouldReceive('driver')->with('google')->andReturn
        ($providerMock);
        $loginResponse = $this->call('GET', route('login', ['provider' =>
                                                            'google']));
        $loginResponse->assertStatus(200);
    }


    public function testLogout()
    {
        Sanctum::actingAs(
            User::factory()->create(),
        );
        $response = $this->get('/api/logout');
        $response->assertStatus(200); // redirect
    }

    public function testGetCurrentUser()
    {
        Sanctum::actingAs(
            User::factory()->create(),
        );
        $response = $this->get('/api/current');
        $response->assertStatus(200);
    }

    public function testGetUsers()
    {
        Sanctum::actingAs(
            User::factory()->create(),
        );
        $response = $this->get('/api/users');
        $response->assertStatus(200);
    }
}
