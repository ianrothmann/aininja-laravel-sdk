<?php

namespace IanRothmann\AINinja\Tests;

use Dotenv\Dotenv;
use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;
use IanRothmann\AINinja\AINinjaServiceProvider;

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
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../', '.env.testing');
        $dotenv->load();
        config()->set('aininja.token', env('AININJA_TOKEN'));
    }
}
