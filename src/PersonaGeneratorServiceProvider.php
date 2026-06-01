<?php

namespace PersonaGenerator;

use Closure;
use Illuminate\Support\ServiceProvider;
use PersonaGenerator\Contracts\LocaleRepository;
use PersonaGenerator\Contracts\ProseDriver;
use PersonaGenerator\Prose\AiProseDriver;
use PersonaGenerator\Prose\TemplateProseDriver;
use PersonaGenerator\Support\ArrayLocaleRepository;

class PersonaGeneratorServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/persona-generator.php', 'persona-generator');

        $this->app->bind(LocaleRepository::class, function ($app): LocaleRepository {
            $config = $app['config']['persona-generator'];
            $basePath = $config['data_path'] ?? __DIR__.'/../resources/lang';

            return new ArrayLocaleRepository($basePath, $config['default_locale']);
        });

        $this->app->bind(PersonaFactory::class, function ($app): PersonaFactory {
            return new PersonaFactory(
                $app->make(LocaleRepository::class),
                $this->proseFactory($app),
            );
        });
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/persona-generator.php' => config_path('persona-generator.php'),
        ], 'persona-generator-config');

        $this->publishes([
            __DIR__.'/../resources/lang' => resource_path('vendor/persona-generator'),
        ], 'persona-generator-data');
    }

    /**
     * A closure that builds the right ProseDriver for a given locale repository.
     *
     * @return Closure(LocaleRepository): ProseDriver
     */
    private function proseFactory($app): Closure
    {
        $config = $app['config']['persona-generator'];

        return function (LocaleRepository $locale) use ($config): ProseDriver {
            $template = new TemplateProseDriver($locale);

            if (! ($config['ai']['enabled'] ?? false)) {
                return $template;
            }

            return new AiProseDriver(
                fallback: $template,
                provider: $config['ai']['provider'] ?? 'anthropic',
                model: $config['ai']['model'] ?? null,
            );
        };
    }
}
