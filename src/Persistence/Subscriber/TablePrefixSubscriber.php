<?php

namespace Aaronadal\WordpressBridgeBundle\Persistence\Subscriber;


use Aaronadal\WordpressBridgeBundle\Persistence\Annotation\WordpressTable;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\Reader;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Event\LoadClassMetadataEventArgs;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Mapping\ClassMetadataInfo;

class TablePrefixSubscriber implements EventSubscriber
{

    protected $tablesPrefix;
    protected $annotatonReader;

    public function __construct($tablesPrefix, Reader $annotatonReader = null)
    {
        $this->tablesPrefix    = $tablesPrefix;
        $this->annotatonReader = $annotatonReader ?: new AnnotationReader();
    }

    public function getSubscribedEvents()
    {
        return ['loadClassMetadata'];
    }

    public function loadClassMetadata(LoadClassMetadataEventArgs $args)
    {
        $metadata = $args->getClassMetadata();

        if(!$metadata->getReflectionClass()) {
            return;
        }

        $classAnnotations = $this->annotatonReader->getClassAnnotations($metadata->getReflectionClass());
        foreach($classAnnotations as $annotation) {
            if($annotation instanceof WordpressTable) {
                $this->manageWordpressAnnotation($args->getEntityManager(), $metadata, $annotation->prefixBlog());

                return;
            }
        }
    }

    private function manageWordpressAnnotation(EntityManager $entityManager, ClassMetadata $metadata, $prefixBlog)
    {
        $prefix = $this->getPrefix($entityManager, $prefixBlog);

        // Prefix this table.
        $metadata->setPrimaryTable(
            [
                'name' => $prefix . $metadata->getTableName(),
            ]
        );

        // Prefix its join tables.
        foreach($metadata->getAssociationMappings() as $fieldName => $mapping) {
            $isManyToMany = $mapping['type'] == ClassMetadataInfo::MANY_TO_MANY;
            $isOwningSide = $mapping['isOwningSide'];
            $hasJoinTable = array_key_exists('joinTable', $mapping);
            if($isManyToMany && $isOwningSide && $hasJoinTable) {
                $mappedTableName                                                = $metadata->associationMappings[$fieldName]['joinTable']['name'];
                $metadata->associationMappings[$fieldName]['joinTable']['name'] = $prefix . $mappedTableName;
            }
        }
    }

    /**
     * Returns the table prefix for entity, with blog ID appened if needed
     *
     * @param EntityManager $entityManager
     * @param bool          $prefixBlog
     *
     * @return string
     */
    private function getPrefix($entityManager, $prefixBlog = true)
    {
        $prefix = $this->tablesPrefix;

        // users and usermeta table won't have blog ID appended.
        if(!$prefixBlog) {
            return $prefix;
        }

        if(method_exists($entityManager, 'getBlogId')) {
            $blogId = $entityManager->getBlogId();

            // append blog ID to prefix
            if($blogId > 1) {
                $prefix = $prefix . $blogId . '_';
            }
        }

        return $prefix;
    }
}
