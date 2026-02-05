<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define los comandos programados.
     */
    protected function schedule(Schedule $schedule)
    {
        // Ejecutar comando todos los dias a las 23:00
        $schedule->command('turismo:importar')->dailyAt('23:00');
    }

    /** Registra los comandos de Artisan. */
    protected function commands()
    {
        // Carga todos los comandos 
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
