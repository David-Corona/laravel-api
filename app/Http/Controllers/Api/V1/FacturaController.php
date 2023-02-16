<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Factura;
use App\Http\Requests\StoreFacturaRequest;
use App\Http\Requests\UpdateFacturaRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\FacturaResource;
use App\Http\Resources\V1\FacturaCollection;
use App\Filters\V1\FacturasFilter;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        $filter = new FacturasFilter();
        $queryItems = $filter->transform($request);

        if (count($queryItems) == 0) {
            return response(new FacturaCollection(Factura::paginate()));
        } else {
            $facturas = Factura::where($queryItems)->paginate();
            return response(new FacturaCollection($facturas->appends($request->query())));
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
    public function store(StoreFacturaRequest $request): RedirectResponse
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Factura $factura): Response
    {
        return response(new FacturaResource($factura));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Factura $factura): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFacturaRequest $request, Factura $factura): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Factura $factura): RedirectResponse
    {
        //
    }
}
