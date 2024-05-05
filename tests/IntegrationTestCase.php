<?php

namespace IanRothmann\AINinja\Tests;

use Dotenv\Dotenv;
use IanRothmann\AINinja\AINinjaServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;

class IntegrationTestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'IanRothmann\\AINinja\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            AINinjaServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        // Check if AININJA_TOKEN is not already set
        if (! env('AININJA_TOKEN')) {
            // Define the path to the .env.testing file
            $envPath = __DIR__.'/../';
            $envFile = $envPath.'.env.testing';

            // Check if .env.testing file exists
            if (file_exists($envFile)) {
                $dotenv = Dotenv::createImmutable($envPath, '.env.testing');
                $dotenv->load();
            }
        }
        config()->set('aininja.token', env('AININJA_TOKEN'));
    }
}
