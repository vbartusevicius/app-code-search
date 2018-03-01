<?php

namespace Vb\Bundle\CodeSearchBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('vb_code_search');

        $rootNode
            ->children()
                ->scalarNode('search_handler')->cannotBeEmpty()->end()
                ->arrayNode('github')
                    ->children()
                        ->scalarNode('username')->cannotBeEmpty()->end()
                        ->scalarNode('token')->cannotBeEmpty()->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
