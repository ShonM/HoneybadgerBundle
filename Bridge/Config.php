<?php

namespace Chesscom\HoneybadgerBundle\Bridge;

use Honeybadger\Config as BaseConfig;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Config extends BaseConfig
{
    public function __construct(ContainerInterface $container)
    {
        parent::__construct(array(
            'debug'            => $container->getParameter('kernel.debug'),
            'project_root'     => realpath($container->getParameter('kernel.root_dir') . '/..'),
            'environment_name' => $container->getParameter('kernel.environment'),
            'async'            => $container->getParameter('chesscom_honeybadger.async'),
            'api_key'          => $container->getParameter('chesscom_honeybadger.api_key'),
            'client_key'       => $container->getParameter('chesscom_honeybadger.client_key'),
        ));
    }
}
