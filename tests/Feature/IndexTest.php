<?php

namespace Tests\Feature;

use App\Traits\GameTypes;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Validator;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IndexTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testHomepageLoads()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testTrackingFormFailsOnEmpty()
    {
        $res = $this->post('/track', [
            'rsn' => '',
            'game'  =>  GameTypes::RS3
        ]);

        $res->assertStatus(302)
            ->assertRedirect("/");
    }

    public function testTrackingAvoidsInvalidUsernames()
    {
        $res = $this->post('/track', [
            'rsn' => '*$$',
            'game'  =>  GameTypes::RS3
        ]);

        $res->assertStatus(302)
            ->assertRedirect("/");
    }

    public function testTrackingFormTracks()
    {
        $response = $this->post('/track', [
            'rsn' => 'null0r',
            'game'  =>  GameTypes::RS3
        ]);

        $response->assertStatus(302)
                 ->assertRedirect("/rs3/null0r");
    }

    public function testTrackingWithNoGame()
    {
        $res = $this->post('/track', [
            'rsn'   =>  'null0r',
        ]);

        $res->assertStatus(302)
            ->assertRedirect('/');
    }
}
