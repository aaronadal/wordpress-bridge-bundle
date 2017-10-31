<?php

namespace Aaronadal\WordpressBridgeBundle\Persistence\Types;


use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\BigIntType;
use Doctrine\DBAL\Types\StringType;

/**
 * @author Aarón Nadal <aaronadal.dev@gmail.com>
 */
class WordpressStatementType extends StringType
{

    const TYPE_NAME = 'wp_statement';

    /**
     * @inheritdoc
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if($value === true) {
            return 'yes';
        }

        return 'no';
    }

    /**
     * @inheritdoc
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if($value === 'yes') {
            return true;
        }

        return false;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return self::TYPE_NAME;
    }
}
