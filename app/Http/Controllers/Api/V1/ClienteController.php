<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Cliente;
use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ClienteResource;
use App\Http\Resources\V1\ClienteCollection;
use App\Services\V1\ClienteQuery;
// use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        $filter = new ClienteQuery();
        $queryItems = $filter->transform($request); //return Array: [['column', 'operator', 'value']]

        if (count($queryItems) == 0) { //if no filters
            return response(new ClienteCollection(Cliente::paginate())); //automatically uses ClienteResource
        } else {
            return response(new ClienteCollection(Cliente::where($queryItems)->paginate()));
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClienteRequest $request): RedirectResponse
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente): Response
    {
        return response(new ClienteResource($cliente));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClienteRequest $request, Cliente $cliente): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente): RedirectResponse
    {
        //
    }
}
