<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileResource;
use App\Models\Profile;

class ProfileController extends Controller
{
    /**
     * Return the single portfolio profile record.
     * Creates an empty record on the fly if none exists yet.
     */
    public function show(): ProfileResource
    {
        return new ProfileResource(Profile::instance());
    }
}
