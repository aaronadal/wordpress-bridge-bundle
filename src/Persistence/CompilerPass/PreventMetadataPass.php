<?php

namespace Aaronadal\WordpressBridgeBundle\Persistence\CompilerPass;


use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * @author  Aarón Nadal <aaronadal.dev@gmail.com>
 *
 * @package Aaronadal\WordpressBridgeBundle\Persistence\CompilerPass
 */
class PreventMetadataPass implements CompilerPassInterface
{

    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $preventedNamespaces = $container->getParameter('aaronadal.wp.entity_namespaces');
        $driverDefinition    = $container->getDefinition('doctrine.orm.default_metadata_driver');
        $methodCalls         = $driverDefinition->getMethodCalls();

        foreach($methodCalls as $key => $call) {
            if('addDriver' === $call[0] && in_array($call[1][1], $preventedNamespaces)) {
                unset($methodCalls[$key]);
            }
        }

        $driverDefinition->setMethodCalls($methodCalls);
    }
}
