<?php

namespace App\Adapters\ViewModels;

use App\Domain\Interfaces\IViewModel;
use Illuminate\Console\Command;

class CliIViewModel implements IViewModel
{
    public function __construct(
        private \Closure $handler
    ) {
    }

    public function handle(Command $command): mixed
    {
        return $this->handler->call($command, $command);
    }
}
