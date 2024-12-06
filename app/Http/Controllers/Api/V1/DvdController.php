<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Dvd;
use App\Http\Requests\DvdRequest;
use App\Http\Requests\UpdateDvdRequest;
use Illuminate\Http\Response;

class DvdController extends Controller
{
    public function __construct(private readonly Dvd $dvd) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json($this->dvd->paginate(25));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DvdRequest $request)
    {
        return response()->json($this->dvd->create($request->validated()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Dvd $dvd)
    {
        return response()->json($dvd);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DvdRequest $request, Dvd $dvd)
    {
        $this->dvd->update($request->validated());

        return response()->json($this->dvd->find($dvd->id));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dvd $dvd)
    {
        $dvd->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
