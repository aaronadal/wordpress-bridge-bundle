<?php

namespace Aaronadal\WordpressBridgeBundle\DependencyInjection;


use Aaronadal\WordpressBridgeBundle\Exception\InvalidShortcodeException;
use Aaronadal\WordpressBridgeBundle\Shortcode\ShortcodeInterface;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * @author Aarón Nadal <aaronadal.dev@gmail.com>
 */
class ShortcodeCompilerPass implements CompilerPassInterface
{

    const TAG_NAME = 'aaronadal.wp.shortcode';

    /**
     * @param ContainerBuilder $container
     *
     * @throws InvalidShortcodeException
     */
    public function process(ContainerBuilder $container)
    {
        if(!$container->has('aaronadal.wp.shortcode_parser')) {
            return;
        }

        $parserDefinition = $container->findDefinition('aaronadal.wp.shortcode_parser');
        $taggedServices   = $container->findTaggedServiceIds(self::TAG_NAME);

        foreach($taggedServices as $id => $attributes) {
            $shortcodeDefinition = $container->findDefinition($id);
            $definitionClass     = $shortcodeDefinition->getClass();
            if(!is_subclass_of($definitionClass, ShortcodeInterface::class)) {
                throw new InvalidShortcodeException(
                    'All shortcodes must implement ShortcodeInterface'
                );
            }

            $shortcodeDefinition->addMethodCall('setShortcodeParser', [new Reference('aaronadal.wp.shortcode_parser')]);
            $parserDefinition->addMethodCall('addShortcode', [new Reference($id)]);
        }
    }
}
