## About This Program
For a Malaysian company. Feel free to evaluate :)
## Installation
1. Make sure you have composer and php. Any version do, but this program is tested in php 7.3.27
2. Run `composer install`

### Usage:
Several ways to use:
1. One line input
> php artisan command:stringConverterAndSaver insert-text-here
2. Multiline input
> php artisan command:stringConverterAndSaver

The result of the CSV will be stored in the root of the folder with name **result.csv**
### Testing:
Run the command below:
> vendor/bin/phpunit tests/Unit/Console/Commands/StringConverterAndSaverTest.php