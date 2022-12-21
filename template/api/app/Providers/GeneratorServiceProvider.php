<?php

namespace App\Providers;

use App\Console\Commands\GenerateModelCommand;
use Illuminate\Support\ServiceProvider;
use Krlove\EloquentModelGenerator\EloquentModelBuilder;
use App\Supports\Processor\CustomPrimaryKeyProcessor;
use App\Supports\Processor\CustomPropertyProcessor;
use App\Supports\Processor\ExistenceCheckerProcessor;
use App\Supports\Processor\FieldProcessor;
use App\Supports\Processor\NamespaceProcessor;
use App\Supports\Processor\RelationProcessor;
use App\Supports\Processor\TableNameProcessor;

/**
 * Class GeneratorServiceProvider
 * @package Krlove\EloquentModelGenerator\Provider
 */
class GeneratorServiceProvider extends ServiceProvider
{
    /** @var string|mixed  */
    const PROCESSOR_TAG = 'eloquent_model_generator.processor';

    /**
     * {@inheritDoc}
     */
    public function register()
    {
        $this->commands([
            GenerateModelCommand::class,
        ]);

        $this->app->tag([
            ExistenceCheckerProcessor::class,
            FieldProcessor::class,
            NamespaceProcessor::class,
            RelationProcessor::class,
            CustomPropertyProcessor::class,
            TableNameProcessor::class,
            // CustomPrimaryKeyProcessor::class,
        ], self::PROCESSOR_TAG);

        $this->app->bind(EloquentModelBuilder::class, function ($app) {
            return new EloquentModelBuilder($app->tagged(self::PROCESSOR_TAG));
        });
    }
}
