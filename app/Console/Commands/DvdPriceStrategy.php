<?php

namespace App\Console\Commands;

use App\Models\Dvd;
use Illuminate\Console\Command;

class DvdPriceStrategy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:dvd-price-strategy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Strategy to update the price of a DVD';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->comment('Executando a tarefa...');

        Dvd::query()->increment('price', 1);

        $this->info('Tarefa executada com sucesso!');
    }
}
