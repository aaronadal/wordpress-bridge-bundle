<?php

namespace Aaronadal\WordpressBridgeBundle\DependencyInjection;


use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class AaronadalWordpressBridgeExtension extends Extension
{

    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config        = $this->processConfiguration($configuration, $configs);

        $config['entity_namespaces'][] = 'Aaronadal\\WordpressBridgeBundle\\Entity';
        $container->setParameter('aaronadal.wp.entity_namespaces', $config['entity_namespaces']);
        $container->setParameter('aaronadal.wp.table_prefix', $config['table_prefix']);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');
    }
}
