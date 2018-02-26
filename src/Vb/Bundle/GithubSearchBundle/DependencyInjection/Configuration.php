<?php

namespace Vb\Bundle\GithubSearchBundle\DependencyInjection;

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
        $rootNode = $treeBuilder->root('vb_github_search');

        $rootNode
            ->children()
                ->scalarNode('username')->cannotBeEmpty()->end()
                ->scalarNode('token')->cannotBeEmpty()->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
