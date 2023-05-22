<?php

namespace Modules\User\src\Commands;

use Illuminate\Console\Command;

class TienHaiCommand extends Command
{
    protected $signature = 'tienhai';

    protected $description = 'Command description';

    public function handle()
    {
        $this->info("success");
    }
}