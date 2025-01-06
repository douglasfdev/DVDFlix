<?php

namespace App\Console\Commands;

use App\Models\SalesComission;
use Illuminate\Console\Command;
use Prometheus\CollectorRegistry;

class SumAllSellersComissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'prometheus:sum-all-sellers-comission';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will sum all comissions of all sellers';

    /**
     * Execute the console command.
     */
    public function handle(CollectorRegistry $registry, int $count = 1)
    {
        $this->comment('Executando a tarefa...');

        $this->createSellerComissionSum($registry, $count);

        $this->info('Tarefa executada com sucesso!');

        return Command::SUCCESS;
    }

    private function createSellerComissionSum(CollectorRegistry $registry, int $count = 1): void
    {
        $counter = $registry->getOrRegisterCounter(namespace: 'sellerComissionsSum', help: 'Sellers comissions sum', labels: ['comission'], name: 'seller_comission');

        $counter->incBy($count, ['comission' => SalesComission::sum('comission')]);
    }
}
