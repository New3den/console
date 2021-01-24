<?php

namespace New3den\Console;

use Exception;
use RuntimeException;
use League\Container\Container;
use Composer\Autoload\ClassLoader;
use Symfony\Component\Console\Application;

class Console {
    public function __construct(
        public Container $container,
        public ClassLoader $autoloader,
        public ?Application $console = null,
        public string $namespace = 'New3den\\Commands',
        public string $cliName = 'New3den',
        public string $version = '1.0.0'
    ) {
        // Load the console if no console is passed through
        $this->console = $this->console ?? new Application($this->cliName, $this->version);
    }

    public function setNamespace(string $namespace): void
    {
        $this->namespace = $namespace;
    }

    public function getNamespace(): string
    {
        return $this->namespace;
    }

    public function run(): int
    {
        // Load the commands
        foreach($this->autoloader->getClassMap() as $class => $path) {
            if (str_starts_with($class, $this->namespace)) {
                $this->console->add($this->container->get($class));
            }
        }

        try {
            return $this->console->run();
        } catch (Exception $e) {
            throw new RuntimeException("Error running CLi: {$e->getMessage()}");
        }
    }
}
