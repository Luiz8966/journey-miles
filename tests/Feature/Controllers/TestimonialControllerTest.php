<?php

namespace Tests\Feature\Controllers;

use App\Models\Testimonial;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class TestimonialControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_testimonials_get_all_endpoint_should_return_status_code_200(): void
    {
        $testimonials = Testimonial::factory(3)->create();

        $response = $this->get('/api/testimonials');
        $testimonial = $testimonials->first();

        $response->assertStatus(200);
        $response->assertJsonCount(3);
        $response->assertJson(function (AssertableJson $json) use ($testimonial) {
            $json->hasAll([
                '0.id',
                '0.persons_name',
                '0.testimonial',
                '0.photo_path',
                '0.created_at',
                '0.updated_at'
            ]);
            $json->whereAllType([
                '0.id' => 'integer',
                '0.persons_name' => 'string',
                '0.testimonial' => 'string',
                '0.photo_path' => 'string',
                '0.created_at' => 'string',
                '0.updated_at' => 'string',
            ]);
            $json->whereAll([
                '0.id' => $testimonial->id,
                '0.persons_name' => $testimonial->persons_name,
                '0.testimonial' => $testimonial->testimonial,
                '0.photo_path' => $testimonial->photo_path,
                '0.created_at' => $testimonial->created_at->toISOString(),
                '0.updated_at' => $testimonial->updated_at->toISOString(),
            ]);
        });
    }

    public function test_testimonials_get_single_endpoint_should_return_status_code_200(): void
    {
        $testimonial = Testimonial::factory(1)->createOne();

        $response = $this->get("/api/testimonials/{$testimonial->id}");

        $response->assertStatus(200);
        $response->assertJson(function (AssertableJson $json) use ($testimonial) {
            $json->hasAll([
                'id',
                'persons_name',
                'testimonial',
                'photo_path',
                'created_at',
                'updated_at'
            ]);
            $json->whereAllType([
                'id' => 'integer',
                'persons_name' => 'string',
                'testimonial' => 'string',
                'photo_path' => 'string',
                'created_at' => 'string',
                'updated_at' => 'string',
            ]);
            $json->whereAll([
                'id' => $testimonial->id,
                'persons_name' => $testimonial->persons_name,
                'testimonial' => $testimonial->testimonial,
                'photo_path' => $testimonial->photo_path,
                'created_at' => $testimonial->created_at->toISOString(),
                'updated_at' => $testimonial->updated_at->toISOString(),
            ]);
        });
    }

    public function test_testimonials_post_endpoint_should_return_status_code_201(): void
    {
        $testimonial = Testimonial::factory(1)->makeOne()->toArray();

        $response = $this->postJson('/api/testimonials', $testimonial);

        $response->assertStatus(201);
        $response->assertJson(function (AssertableJson $json) use ($testimonial) {
            $json->hasAll([
                'id',
                'persons_name',
                'testimonial',
                'photo_path',
                'created_at',
                'updated_at',
            ]);
            $json->whereAllType([
                'id' => 'integer',
                'persons_name' => 'string',
                'testimonial' => 'string',
                'photo_path' => 'string',
                'created_at' => 'string',
                'updated_at' => 'string',
            ]);
            $json->whereAll([
                'persons_name' => $testimonial['persons_name'],
                'testimonial' => $testimonial['testimonial'],
                'photo_path' => $testimonial['photo_path'],
            ])->etc();
        });
    }

    public function test_testimonials_update_endpoint_should_return_status_code_200(): void
    {
        $testimonial = Testimonial::factory(1)->createOne()->toArray();

        $testimonial['persons_name'] = $this->faker()->name();
        $testimonial['testimonial'] = $this->faker()->text();
        $testimonial['photo_path'] = $this->faker()->filePath();

        $response = $this->putJson("/api/testimonials/{$testimonial['id']}", $testimonial);

        $response->assertStatus(200);
        $response->assertJson(function (AssertableJson $json) use ($testimonial) {
            $json->whereAll([
                'id' => $testimonial['id'],
                'persons_name' => $testimonial['persons_name'],
                'testimonial' => $testimonial['testimonial'],
                'photo_path' => $testimonial['photo_path'],
            ])->etc();
        });
    }

    public function test_testimonials_delete_endpoint_should_return_status_code_204(): void
    {
        $testimonial = Testimonial::factory(1)->createOne();

        $response = $this->deleteJson("/api/testimonials/{$testimonial->id}");

        $response->assertStatus(204);
    }
}
