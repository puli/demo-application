<?php

namespace Puli\DemoApplication;

use Closure;
use Puli\Extension\Twig\PuliExtension;
use Puli\Extension\Twig\PuliTemplateLoader;
use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Twig_Environment;

class DemoApplication extends Application
{
    public function __construct()
    {
        parent::__construct();

        $app = $this;

        $this->register(new TwigServiceProvider());

        $this['puli.factory'] = $this->share(function () {
            $factoryClass = PULI_FACTORY_CLASS;

            return new $factoryClass();
        });

        $this['puli.repository'] = $this->share(function (Application $app) {
            return $app['puli.factory']->createRepository();
        });

        $this['puli.discovery'] = $this->share(function (Application $app) {
            return $app['puli.factory']->createDiscovery($app['puli.repository']);
        });

        $this['puli.url_generator'] = $this->share(function (Application $app) {
            return $app['puli.factory']->createUrlGenerator($app['puli.discovery']);
        });

        /** @var Closure $twig */
        $twig = $this->raw('twig');

        $this['twig.options'] = array(
            'cache' => realpath(__DIR__.'/..').'/var/cache/twig',
        );

        $this['twig.loader'] = $this->share(function (Application $app) {
            return new PuliTemplateLoader($app['puli.repository']);
        });

        $this['twig'] = $this->share(function (Application $app) use ($twig) {
            $twig = $twig($app);

            /** @var Twig_Environment $twig */
            $twig->addExtension(new PuliExtension($app['puli.repository'], $app['puli.url_generator']));

            return $twig;
        });

        $this->get('/', function () use ($app) {
            return $app['twig']->render('/app/views/index.html.twig');
        });
    }
}
