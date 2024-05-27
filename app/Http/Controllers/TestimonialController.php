<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use App\Http\Requests\TestimonialRequest;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::all();
        return response()->json($testimonials);
    }

    public function store(TestimonialRequest $request)
    {
        $testimonial = Testimonial::create($request->all());
        return response()->json($testimonial, 201);
    }

    public function show(string $id)
    {
        $testimonial = Testimonial::find($id);
        return response()->json($testimonial);
    }

    public function update(TestimonialRequest $request, string $id)
    {
        $testimonial = Testimonial::find($id);

        if (!$testimonial) return response()->json('Testimonial not found', 404);

        $testimonial->fill($request->all());
        $testimonial->save();

        return response()->json($testimonial);
    }

    public function destroy(string $id)
    {
        $testimonial = Testimonial::find($id);

        if (!$testimonial) return response()->json('Testimonial not found', 404);

        $testimonial->delete();

        return response()->noContent();
    }
}
