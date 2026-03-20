<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactMessageRequest;
use App\Http\Resources\ContactMessageResource;
use App\Models\ContactMessage;
use Illuminate\Http\JsonResponse;

class ContactController extends Controller
{
    /**
     * Store a new contact message from the public portfolio.
     */
    public function store(StoreContactMessageRequest $request): JsonResponse
    {
        $message = ContactMessage::create($request->validated());

        return response()->json([
            'message' => 'Thank you! Your message has been received. I will get back to you soon.',
            'data'    => new ContactMessageResource($message),
        ], 201);
    }
}
