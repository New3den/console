# New3den/Console

### Requirements
1. PSR-11 compatible container
2. PHP8.0 or higher

### bin/console example

```php
<?php
declare(strict_types=1);

$autoloaderPath = __DIR__ . '/../vendor/autoload.php';
if(!file_exists($autoloaderPath)) {
    throw new RuntimeException('Error, composer is not setup correctly.. Please run composer install');
}

$autoloader = require $autoloaderPath;

# Container
$container = new \League\Container\Container();

# Load the CLI
$cli = new \New3den\Console\Console($container, $autoloader);

# Define the class scope to load commands from
$cli->setNamespace('New3den\\Commands');

# Define the name
$cli->setConsoleName('New3den');

# Define the version
$cli->setVersion('1.0.0');

# Run the cli
$cli->run();
```

### Command example

```php
<?php
declare(strict_types=1);

namespace New3den\Commands;

/**
 * @property string $stringInput
 */
class Command extends \New3den\Console\ConsoleCommand
{
    protected string $signature = 'command {--stringInput=Hello World : Some string to pass into the command }';
    protected string $description = 'This is an example command';
    
    public function handle(): void
    {
        $this->out($this->stringInput);
    }
}
```
