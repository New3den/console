<?php

namespace New3den\Console;

use Exception;
use RuntimeException;
use Composer\Autoload\ClassLoader;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Application;

class Console {
    public function __construct(
        public ContainerInterface $container,
        public ClassLoader $autoloader,
        public ?Application $console = null,
        protected string $commandsNamespace = 'New3den\\Commands',
        protected string $consoleName = 'New3den',
        protected string $version = '1.0.0'
    ) {
    }

    public function run(): int
    {
        // Load the console if no console is passed through
        $this->console = $this->console ?? new Application($this->consoleName, $this->version);

        // Load the commands
        foreach($this->autoloader->getClassMap() as $class => $path) {
            if (str_starts_with($class, $this->commandsNamespace)) {
                $this->console->add($this->container->get($class));
            }
        }

        // Run the console (or fail)
        try {
            return $this->console->run();
        } catch (Exception $e) {
            throw new RuntimeException("Error running CLi: {$e->getMessage()}");
        }
    }

    public function setCommandsNamespace(string $commandsNamespace): void
    {
        $this->commandsNamespace = $commandsNamespace;
    }

    public function getCommandsNamespace(): string
    {
        return $this->commandsNamespace;
    }

    public function getConsoleName(): string
    {
        return $this->consoleName;
    }

    public function setConsoleName(string $consoleName): void
    {
        $this->consoleName = $consoleName;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    public function setVersion(string $version): void
    {
        $this->version = $version;
    }
}
