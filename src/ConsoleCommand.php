<?php

namespace New3den\Console;

abstract class ConsoleCommand extends ConsoleCommandHelper
{
    protected string $signature;
    protected string $description;

    abstract public function handle(): void;
}
