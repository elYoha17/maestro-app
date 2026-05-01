<?php

namespace App\Http\Controllers;

use App\Actions\Agent\CreateAgent;
use App\Http\Requests\StoreAgentRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UserAgentController extends Controller
{
    public function store(StoreAgentRequest $request, User $user): RedirectResponse
    {
        app(CreateAgent::class)($user, $request->validated());

        return back();
    }
}
