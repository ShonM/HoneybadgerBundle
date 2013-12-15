<?php

namespace Chesscom\HoneybadgerBundle\DependencyInjection;

use Honeybadger\Config;
use Honeybadger\Honeybadger;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

class ChesscomHoneybadgerExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');

        $container->setParameter('chesscom_honeybadger.api_key', $config['api_key']);
        $container->setParameter('chesscom_honeybadger.client_key', $config['client_key']);
        $container->setParameter('chesscom_honeybadger.async', $config['async']);
        $container->setParameter('chesscom_honeybadger.ignored_exceptions', $config['ignored_exceptions']);

        Honeybadger::init();

        Honeybadger::$config = new Config(array(
            'debug'            => $container->getParameter('kernel.debug'),
            'project_root'     => $container->getParameter('kernel.root_dir'),
            'environment_name' => $container->getParameter('kernel.environment'),
            'async'            => $container->getParameter('chesscom_honeybadger.async'),
            'api_key'          => $container->getParameter('chesscom_honeybadger.api_key'),
            // 'client_key'       => $container->getParameter('chesscom_honeybadger.client_key'),
        ));
    }
}
