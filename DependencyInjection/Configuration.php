<?php

namespace Chesscom\HoneybadgerBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('chesscom_honeybadger');

        $rootNode
            ->children()
                ->scalarNode('api_key')->defaultFalse()->end()
                ->scalarNode('client_key')->defaultFalse()->end()
                ->booleanNode('async')->defaultTrue()->end()
                ->variableNode('ignored_exceptions')->defaultValue(array('Symfony\Component\HttpKernel\Exception\HttpException'))->end()
            ->end();

        return $treeBuilder;
    }
}
