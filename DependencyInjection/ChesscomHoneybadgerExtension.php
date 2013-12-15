<?php

namespace Chesscom\HoneybadgerBundle\DependencyInjection;

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
    }
}
