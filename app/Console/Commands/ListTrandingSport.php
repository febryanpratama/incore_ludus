<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\GenerateServices;

class ListTrandingSport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sport:list-tranding';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Menampilkan atau memproses list trending sport dari API';

    private $generateServices;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(GenerateServices $generateServices)
    {
        parent::__construct();

        $this->generateServices = $generateServices;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Panggil service
        // $this->generateServices->fetchListTrending();
        // $this->info('Artikel trending sport berhasil di-fetch.');
    }
}
