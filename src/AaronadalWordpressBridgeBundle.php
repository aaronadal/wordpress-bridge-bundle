<?php

namespace Aaronadal\WordpressBridgeBundle;


use Aaronadal\WordpressBridgeBundle\Persistence\CompilerPass\PreventMetadataPass;
use Aaronadal\WordpressBridgeBundle\Persistence\Types\WordpressIdType;
use Aaronadal\WordpressBridgeBundle\Persistence\Types\WordpressSerializedType;
use Aaronadal\WordpressBridgeBundle\Persistence\Types\WordpressStatementType;
use Doctrine\DBAL\Types\Type;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class AaronadalWordpressBridgeBundle extends Bundle
{

    public function boot()
    {
        parent::boot();

        if(!Type::hasType(WordpressSerializedType::TYPE_NAME)) {
            Type::addType(WordpressSerializedType::TYPE_NAME, WordpressSerializedType::class);
        }

        if(!Type::hasType(WordpressIdType::TYPE_NAME)) {
            Type::addType(WordpressIdType::TYPE_NAME, WordpressIdType::class);
        }

        if(!Type::hasType(WordpressStatementType::TYPE_NAME)) {
            Type::addType(WordpressStatementType::TYPE_NAME, WordpressStatementType::class);
        }
    }

    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new PreventMetadataPass());
    }
}
