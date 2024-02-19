<?php

namespace Tests\Feature;

use App\Events\RealTimeMessage;
use App\Models\User;
use App\Services\ExampleService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\Sanctum;
use Mockery\MockInterface;
use Tests\TestCase;

class AnotherExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_see(): void
    {
        $response = $this->get('/');

        $response->assertSee('Latest posts');
        $response->assertDontSee('Latest news');
    }

    /**
     * Test sprawdza, czy elementy znajdują się na stronie.
     */
    public function test_see_password(): void
    {
        $response = $this->get('/register');

        $response->assertSee('Name');
        $response->assertSee('Email');
        $response->assertSee('Password');
        $response->assertSee('Confirm Password');
    }

    public function test_see_auth(): void
    {
        $response = $this->get('/dashboard');

        $response->assertDontSee('You\'re logged in!');
    }

    /**
     * Test sprawdza poprawność logowania, sprawdzając, czy po poprawnym logowaniu zostało wykonane przekierowanie z komunikatem "You're logged in!"
     */
    public function test_logged(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email'    => $user->email,
            'password' => 'password'
        ]);

        $this->assertAuthenticated();

        $response->assertRedirect('dashboard');

        $response = $this->actingAs($user)->get('/dashboard');
        $response->assertSee('You\'re logged in!');

        $this->assertDatabaseCount('users', 1);
    }

    /**
     * Test sprawdza ilość wierszy w bazie danych
     */
    public function test_database_count(): void
    {
        $this->assertDatabaseCount('users', 0);
    }

    /**
     * Test sprawdza pojawienie się napisu "Saved" po zaktualizowaniu danych profilu
     */
    public function test_session(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email'    => $user->email,
            'password' => 'password'
        ]);

        $response = $this->actingAs($user)->withSession([
            'status' => 'profile-updated'
        ])->get('/profile');

        $response->assertSee('Saved');
    }

    /**
     * Metody dump umożliwiają wyświetlanie danych w konsoli
     */
    public function test_dump(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        //$response->dump();
        // $response->dumpSession();
        // $response->dumpHeaders();
    }

    /**
     * Test autoryzacji do API
     */
    public function test_making_an_api_request(): void
    {
        Sanctum::actingAs(
            User::factory()->create()
        );

        $response = $this->get('api/user');
        $response->assertOk();
    }

    /**
     * Test sprawdzający tworzenie posta przez API
     */
    public function test_making_an_api_request_create_post()
    {
        Sanctum::actingAs(
            User::factory()->create()
        );

        $response = $this->postJson('/api/posts/create', [
            'title'   => 'Title Post test API',
            'content' => 'Post content test API'
        ]);

        $response->assertJson([
            'post' => true
        ]);
    }

    /**
     * Test zwraca FAILED
     */
//    public function test_view(): void
//    {
//        $view = $this->view('posts.create', [
//            'errors' => null,
//        ]);
//        $view->assertSee('New blog post');
//    }

    public function test_component(): void
    {
        $component = $this->blade(
            '<x-auth-session-status :status="$status" />',
            ['status' => 'Status 2']
        );

        $component->assertSee('Status 2');
    }

    /**
     * Mock
     * Qurna klasa testowana nie może być klasą finalną :/.
     */
    public function test_mock_service(): void
    {
        $this->mock(ExampleService::class, function (MockInterface $mock) {
            $mock->shouldReceive('execute')->once()->andReturn('fake return');
        });

        $response = $this->get('/test');
        $response->assertSee('fake return');
    }

    /**
     * Mock
     */
    public function test_mock_facade(): void
    {
        Hash::shouldReceive('make')
            ->once()
            ->with('a')
            ->andReturn('value');

        $response = $this->get('/test-facade');
        $response->assertSee('value');
    }

    public function test_event_mock(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email'    => $user->email,
            'password' => 'password'
        ]);

        Event::fake();

        $this->actingAs($user)->post('/posts', [
            'title'   => 'Title Post test API',
            'content' => 'Post content test API'
        ]);

        Event::assertDispatched(RealTimeMessage::class);
    }
}
