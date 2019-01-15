<?php

namespace Aaronadal\WordpressBridgeBundle\DependencyInjection;


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
        if(method_exists(TreeBuilder::class, 'getRootNode')) {
            $treeBuilder = new TreeBuilder('aaronadal_wordpress_bridge');
            $rootNode    = $treeBuilder->getRootNode();
        }
        else {
            $treeBuilder = new TreeBuilder();
            $rootNode    = $treeBuilder->root('aaronadal_wordpress_bridge');
        }

        $rootNode->children()
            ->arrayNode('entity_namespaces')
                ->scalarPrototype()->end()
                ->defaultValue([])
            ->end()
            ->scalarNode('table_prefix')
                ->defaultValue('wp_')
            ->end()
        ->end();

        return $treeBuilder;
    }
}
