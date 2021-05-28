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
3. Test
> php artisan command:stringConverterAndSaver --test
The result of the CSV will be stored in the root of the folder with name **result.csv**
4. Using endpoints (Require you to run `php artisan serve` first OR put it in Laragon)
> Call this endpoint for caps lock: `http://127.0.0.1:8000/api/capslock?words=albert jonathan lorem lipsum`
> Call this endpoint for alternate: `http://127.0.0.1:8000/api/alternate` and insert your sentence with 'words' as the key in your response.
> > Call this endpoint for save a sentence in CSV: `http://127.0.0.1:8000/api/savecsv` and insert your sentence with 'words' as the key in your response.
### Testing:
Run the command below for testing:
Mac OS:
> vendor/bin/phpunit tests/Unit/Console/Commands/StringConverterAndSaverTest.php
> vendor/bin/phpunit tests/Feature/StringConverterControllerTest.php
Windows:
> .\vendor\bin\phpunit .\tests\Feature\StringConverterControllerTest.php
> .\vendor\bin\phpunit .\tests\Unit\Console\Commands\StringConverterAndSaverTest.php
### Note:
For converts the string to alternate upper and lower case and outputs it to stdout section, I revert to lowercase on the next alphabet in case the program found a space. For example `a!b3rt   jon` will be `a!B3rT   jOn`
Also, if the program encounter symbols and number, the next alphabet will be alternated. For example `a!b` will be `a!B`