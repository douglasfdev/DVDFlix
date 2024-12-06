<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Services\PrometheusService;
use  Illuminate\Http\JsonResponse;
use  Prometheus\Exception\MetricsRegistrationException;

class  PrometheusController extends Controller
{
    private PrometheusService $service;

    public  function  __construct(PrometheusService $service)
    {
        $this->service = $service;
    }

    public  function  metrics(): string
    {
        return  $this->service->metrics();
    }

    /**
     * @throws MetricsRegistrationException
     */
    public  function  createTestOrder(): JsonResponse
    {
        $this->service->incrementOrder();

        // Cria códigos de pedido

        return  $this->successResponse('O pedido foi criado com sucesso.');
    }
}
