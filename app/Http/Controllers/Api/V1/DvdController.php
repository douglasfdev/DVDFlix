<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Dvd;
use App\Http\Requests\DvdRequest;
use App\Services\DvdService;

class DvdController extends Controller
{
    public function __construct(private readonly DvdService $dvdService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->dvdService->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DvdRequest $request)
    {
        return $this->dvdService->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Dvd $dvd)
    {
        return $this->dvdService->show($dvd);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DvdRequest $request, Dvd $dvd)
    {
        return $this->dvdService->update($request, $dvd);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dvd $dvd)
    {
        return $this->dvdService->destroy($dvd);
    }
}
