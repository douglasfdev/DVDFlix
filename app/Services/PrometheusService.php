<?php

namespace App\Services;

use App\Models\SalesComission;
use Illuminate\Support\Facades\Log;
use Prometheus\CollectorRegistry;
use Prometheus\Exception\MetricsRegistrationException;
use Prometheus\RenderTextFormat;

class PrometheusService
{
    private CollectorRegistry $collectorRegistry;

    public function __construct(
        CollectorRegistry $registry,
        private readonly SalesComission $salesComission
    ) {
        Log::debug('Constructing PrometheusService');
        $this->collectorRegistry = $registry->getDefault();
    }

    public function metrics(string $secret): string
    {
        if ($secret !== config('metrics.secret')) {
            abort(404);
        }

        $renderer = new RenderTextFormat();

        $result = $renderer->render($this->collectorRegistry->getMetricFamilySamples());

        header('Content-type: ' . RenderTextFormat::MIME_TYPE);

        return response()->json()->header('Content-Type', 'text/plain')->setContent($result);
    }

    /**
     * @throws MetricsRegistrationException
     */
    public function createSellerComissionSum($count = 1): void
    {
        $counter = $this->collectorRegistry->getOrRegisterCounter(namespace: 'sellerComissionsSum', help: 'Sellers comissions sum', labels: ['comission'], name: 'seller_comission');

        $counter->incBy($count, ['comission' => $this->salesComission->sum('comission')]);
    }
}
