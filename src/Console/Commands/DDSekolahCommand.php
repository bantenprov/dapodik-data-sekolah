<?php namespace Bantenprov\DDSekolah\Console\Commands;

use Illuminate\Console\Command;

/**
 * The DDSekolahCommand class.
 *
 * @package Bantenprov\DDSekolah
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class DDSekolahCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bantenprov:dd-sekolah';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Demo command for Bantenprov\DDSekolah package';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Welcome to command for Bantenprov\DDSekolah package');
    }
}
