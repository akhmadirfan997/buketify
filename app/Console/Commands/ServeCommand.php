<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ServeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'serve {--host=127.0.0.1} {--port=8000}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Serve the application on the PHP development server';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $host = $this->option('host');
        $port = $this->option('port');

        $this->info("Starting Laravel development server: http://{$host}:{$port}");
        $this->info('Press Ctrl+C to quit.');

        $command = "php -S {$host}:{$port} -t " . base_path('public');
        
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            // Windows
            pclose(popen("start /B " . $command, "r"));
        } else {
            // Unix/Linux/Mac
            exec($command . ' > /dev/null 2>&1 &');
        }

        return 0;
    }
} 