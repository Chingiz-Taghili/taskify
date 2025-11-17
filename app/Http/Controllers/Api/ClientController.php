<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientCreateRequest;
use App\Http\Requests\ClientUpdateRequest;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::with(['projects', 'tasks'])->get();
        return ClientResource::collection($clients)->additional(['success' => true]);
    }

    public function store(ClientCreateRequest $request)
    {
        $client = Client::create($request->validated());
        return (new ClientResource($client->load(['projects', 'tasks'])))
            ->additional(['success' => true, 'message' => 'Client created successfully'])
            ->response()->setStatusCode(201);
    }

    public function show(Client $client)
    {
        return (new ClientResource($client->load(['projects', 'tasks'])))->additional(['success' => true]);
    }

    public function update(ClientUpdateRequest $request, Client $client)
    {
        $client->update($request->validated());
        return (new ClientResource($client->load(['projects', 'tasks'])))
            ->additional(['success' => true, 'message' => 'Client updated successfully']);
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return response()->json(['success' => true, 'message' => 'Client deleted successfully']);
    }
}
