<?php

namespace Tests\Feature;

use App\User;
use App\Word;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WordReservationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function create_a_word()
    {
        $this->withoutExceptionHandling();
        $this->artisan('db:seed');

        $response = $this->withToken(User::first()->api_token)
            ->post('/api/v1/words', $this->data());

        $response->assertStatus(201);
        $this->assertCount(1, Word::all());
    }

    /** @test */
    public function word_value_is_required()
    {
        $this->artisan('db:seed');

        $response = $this->withToken(User::first()->api_token)
            ->post('/api/v1/words', [
            'value' => ''
        ]);

        $response->assertSessionHasErrors('value');
    }

    /** @test */
    public function a_word_can_be_updated()
    {
        $this->artisan('db:seed');

        $this->withToken(User::first()->api_token)
            ->post('/api/v1/words', $this->data());

        $word = Word::first();

        $response = $this->withToken(User::first()->api_token)
            ->patch($word->path(), [
                'value' => 'reservation',
                ]);

        $this->assertEquals('reservation', Word::first()->value);
        $response->assertRedirect($word->fresh()->path());
    }

    /** @test */
    public function a_word_can_be_deleted()
    {
        $this->artisan('db:seed');

        $this->withToken(User::first()->api_token)
            ->post('/api/v1/words', $this->data());

        $word = Word::first();
        $this->assertCount(1, Word::all());

        $response = $this->actingAs(User::first())->delete($word->path());

        $this->assertCount(0, Word::all());
        $response->assertRedirect('/words');
    }

    private function data()
    {
        return [
            'value' => 'girlfriend',
        ];
    }
}
