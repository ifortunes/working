<?php

namespace Tests\Feature\Api\v;

use App\Models\Advertisement;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiAdvertisementTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_advertisement_index()
    {
        $advertisement = Advertisement::factory()->create();

        $response = $this->json('get', route('advertisements.index'));

        $response->assertOk();

        $this->assertCount(1, $response->json('data'));

        $advertisements = $response->json('data');

        $this->assertEquals($advertisements[0]['id'], $advertisement->id);
    }

    public function test_advertisement_index_params_price()
    {
        $advertisementA = Advertisement::factory()->create(['name' => 'qwerty', 'price' => '215', 'created_at' => Carbon::parse('2017-05-25 00:00')]);
        $advertisementB = Advertisement::factory()->create(['name' => 'qwerty', 'price' => '35', 'created_at' => Carbon::parse('2022-08-05 00:00')]);

        $response = $this->json('get', route('advertisements.index'), [
            'asc' => 'price'
        ]);

        $response->assertOk();

        $advertisements = $response->json('data');

        $this->assertEquals($advertisements[0]['price'], '215');

        $response->assertOk();

        $response = $this->json('get', route('advertisements.index'), [
            'desc' => 'price'
        ]);

        $advertisements = $response->json('data');

        $this->assertEquals($advertisements[0]['price'], '35');

        $response->assertOk();

    }

    public function test_advertisement_index_params_date()
    {
        $advertisementA = Advertisement::factory()->create(['name' => 'qwerty', 'created_at' => Carbon::parse('2017-05-25 00:00')]);
        $advertisementB = Advertisement::factory()->create(['name' => 'qwerty', 'created_at' => Carbon::parse('2022-08-05 00:00')]);

        $response = $this->json('get', route('advertisements.index'), [
            'asc' => 'created_at'
        ]);

        $response->assertOk();

        $advertisements = $response->json('data');

        $this->assertEquals(Carbon::parse($advertisements[0]['created_at'])->toDateTimeString(), Carbon::parse($advertisementA->created_at)->toDateTimeString());

        $response->assertOk();

        $response = $this->json('get', route('advertisements.index'), [
            'desc' => 'created_at'
        ]);

        $response->assertOk();

        $advertisements = $response->json('data');

        $response->assertOk();

        $this->assertEquals(Carbon::parse($advertisements[0]['created_at'])->toDateTimeString(), Carbon::parse($advertisementB->created_at)->toDateTimeString());

        $response->assertOk();
    }

    public function test_advertisement_store()
    {
        $response = $this->json('post', route('advertisements.store'), [
            'name' => 'Qwerty',
            'description' => 'zzzzzzzzzzzzzzz',
            'price' => 50,
            'images' => [
                'https://cdn.quasar.dev/img/parallax2.jpg',
                'https://cdn.quasar.dev/img/parallax2.jpg',
                'https://cdn.quasar.dev/img/parallax2.jpg',
            ]
        ]);

        $response->assertCreated();

        $this->assertDatabaseHas('advertisements', [
            'name' => 'Qwerty'
        ]);

        $response->assertCreated();

        $response = $this->json('post', route('advertisements.store'), [
            'name' => 'Qwerty',
            'description' => 'zzzzzzzzzzzzzzz',
            'price' => 50,
            'images' => [
                'https://cdn.quasar.dev/img/parallax2.jpg',
                'https://cdn.quasar.dev/img/parallax2.jpg',
                'https://cdn.quasar.dev/img/parallax2.jpg',
                'https://cdn.quasar.dev/img/parallax2.jpg',
            ]
        ]);

        $response->assertStatus(422);
    }

    public function test_advertisement_show()
    {
        $advertisementA = Advertisement::factory()->create(
            [
                'id' => 1,
                'name' => 'qwerty',
                'price' => '215',
                'images' => [
                    'https://cdn.quasar.dev/img/parallax2.jpg',
                    'https://cdn.quasar.dev/img/parallax2.jpg',
                    'https://cdn.quasar.dev/img/parallax2.jpg',
                ],
                'created_at' => Carbon::parse('2017-05-25 00:00'),
            ]);

        $this->assertDatabaseHas('advertisements', [
            'id' => 1,
            'name' => 'qwerty',
            'price' => '215',
        ]);

        $response = $this->json('get', route('advertisements.show', 1));

        $response->assertOk();

        $advertisement = $response->json();

        $response->assertOk();

        $this->assertEquals($advertisement['name'], 'qwerty');

        $response->assertOk();

        $response = $this->json('get', route('advertisements.show', 1), ['fields' => 'images']);

        $response->assertOk();

        $advertisement = $response->json();

        $response->assertJsonStructure([
            'images' => []
        ]);
    }
}
