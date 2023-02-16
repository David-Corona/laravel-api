<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Cliente;
use App\Http\Requests\V1\StoreClienteRequest;
use App\Http\Requests\V1\UpdateClienteRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ClienteResource;
use App\Http\Resources\V1\ClienteCollection;
use App\Filters\V1\ClientesFilter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        $filter = new ClientesFilter();
        $filterItems = $filter->transform($request); //return Array: [['column', 'operator', 'value']]

        $includeFacturas = $request->query('includeFacturas');

        $clientes = Cliente::where($filterItems);

        if ($includeFacturas) {
            $clientes = $clientes->with('facturas');
        }

        return response(new ClienteCollection($clientes->paginate()->appends($request->query())));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClienteRequest $request): Response
    {
        return response(new ClienteResource(Cliente::create($request->all())));
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente): Response
    {
        $includeFacturas = request()->query('includeFacturas');

        if ($includeFacturas) {
            return response(new ClienteResource($cliente->loadMissing('facturas')));
        }

        return response(new ClienteResource($cliente));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClienteRequest $request, Cliente $cliente)
    {
        $cliente->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente): RedirectResponse
    {
        //
    }
}
