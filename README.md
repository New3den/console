# New3den/Console

### Requirements
1. League/Container (Either with commands loaded into it manually, or via. Reflection)
2. Composer
3. PHP8.0 or higher

### Example

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

# Load the CLIe
$cli = new \New3den\Console\Console($container, $autoloader);

# Define the class scope to load commands from
$cli->setNamespace('New3den\\Commands');

# Run the cli
$cli->run();
```
