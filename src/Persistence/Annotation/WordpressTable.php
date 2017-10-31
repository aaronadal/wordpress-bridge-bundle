<?php

namespace Aaronadal\WordpressBridgeBundle\Persistence\Annotation;


use Doctrine\ORM\Mapping\Annotation;

/**
 * @Annotation
 * @Target("CLASS")
 */
final class WordpressTable implements Annotation
{

    private $prefix_blog;

    public function __construct(array $values)
    {
        $this->prefix_blog = (bool) ($values['prefix_blog'] ?? false);
    }

    /**
     * Gets the PrefixBlog.
     *
     * @return bool
     */
    public function prefixBlog()
    {
        return $this->prefix_blog;
    }
}
