<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Factura;
use App\Http\Requests\V1\BulkStoreFacturaRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\FacturaResource;
use App\Http\Resources\V1\FacturaCollection;
use App\Filters\V1\FacturasFilter;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;


class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Response
    {
        $filter = new FacturasFilter();
        $filterItems = $filter->transform($request);

        if (count($filterItems) == 0) {
            return response(new FacturaCollection(Factura::paginate()));
        } else {
            $facturas = Factura::where($filterItems)->paginate();
            return response(new FacturaCollection($facturas->appends($request->query())));
        }
    }

    public function bulkStore(BulkStoreFacturaRequest $request)
    {
        $bulk = collect($request->all())->map(function($arr, $key) {    // request information in to a collection
            return Arr::except($arr, ['clienteId', 'fechaFacturacion', 'fechaPago']);
        });

        Factura::insert($bulk->toArray());
    }

    /**
     * Display the specified resource.
     */
    public function show(Factura $factura): Response
    {
        return response(new FacturaResource($factura));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Factura $factura)
    {
        $factura->delete();
    }
}
