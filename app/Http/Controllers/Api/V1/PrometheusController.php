<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\PrometheusService;
use App\Models\SalesComission;
use Illuminate\Http\JsonResponse;
use Prometheus\Exception\MetricsRegistrationException;

class PrometheusController extends Controller
{

    public function __construct(private PrometheusService $service) {}

    public function metrics(string $secret): string
    {
        return $this->service->metrics($secret);
    }

    /**
     * @throws MetricsRegistrationException
     */
    public function createSellerComissionSum(): JsonResponse
    {
        $this->service->createSellerComissionSum();

        return  response()->json(['message' => 'Comission created']);
    }
}
