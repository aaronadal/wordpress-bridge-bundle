<?php

namespace Aaronadal\WordpressBridgeBundle\Persistence\Types;


use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\BigIntType;

/**
 * @author Aarón Nadal <aaronadal.dev@gmail.com>
 */
class WordpressIdType extends BigIntType
{

    const TYPE_NAME = 'wp_id';

    /**
     * @inheritdoc
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if($value === null) {
            $value = 0;
        }

        return $value;
    }

    /**
     * @inheritdoc
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if((int) $value === 0) {
            $value = null;
        }

        return $value;
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return self::TYPE_NAME;
    }
}
