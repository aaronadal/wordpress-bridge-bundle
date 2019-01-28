<?php

namespace Aaronadal\WordpressBridgeBundle\Persistence\Types;


use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\TextType;

/**
 * @author Aarón Nadal <aaronadal.dev@gmail.com>
 */
class WordpressSerializedType extends TextType
{

    const TYPE_NAME = 'wp_serialized';

    /**
     * @inheritdoc
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if(is_array($value) || is_object($value)) {
            $value = serialize($value);
        }

        return $value;
    }

    /**
     * @inheritdoc
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if($this->isSerialized($value)) {
            $value = str_replace("\\", "", $value);
            $value = unserialize($value);
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

    /**
     * Checks if a value is serialized or not.
     *
     * @param  mixed $value Value to check.
     *
     * @return bool  True if value is serialized, false otherwise.
     */
    private function isSerialized($value)
    {
        if(!is_string($value)) {
            return false;
        }

        $value = trim($value);
        if('N;' === $value) {
            return true;
        }

        $length = strlen($value);
        if($length < 4) {
            return false;
        }

        if(':' !== $value[1]) {
            return false;
        }

        $last = $value[$length - 1];
        if(';' !== $last && '}' !== $last) {
            return false;
        }

        switch($value[0]) {
            case 's':
                if('"' !== $value[$length - 2]) {
                    return false;
                }
            case 'a':
            case 'O':
                return (bool) preg_match("/^{$value[0]}:[0-9]+:/s", $value);
            case 'b':
            case 'i':
            case 'd':
                return (bool) preg_match("/^{$value[0]}:[0-9.E-]+;\$/", $value);
        }

        return false;
    }
}
