<?php

declare(strict_types=1);

namespace MyHammer\Job\Form\DataTransformer;

use Doctrine\DBAL\Types\ConversionException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

/**
 * Class EntityToUuidTransformer
 *
 * @package MyHammer\Job\Form\DataTransformer
 */
class EntityToUuidTransformer implements DataTransformerInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var string
     */
    private $classType;

    /**
     * EntityToUuidTransformer constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param string $classType
     */
    public function __construct(EntityManagerInterface $entityManager, string $classType)
    {
        $this->entityManager = $entityManager;
        $this->classType = $classType;
    }

    /**
     * {@inheritdoc}
     */
    public function transform($entity)
    {
        if (null === $entity) {
            return '';
        }

        return $entity->getUuid();
    }

    /**
     * {@inheritdoc}
     */
    public function reverseTransform($uuid)
    {
        if (!$uuid) {
            return;
        }

        try {
            $entity = $this->entityManager->getRepository($this->classType)
                ->find($uuid);
        } catch (ConversionException $exception) {
            throw new TransformationFailedException(sprintf('"%s" is not a valid UUId', $uuid), 0, $exception);
        }

        if (null === $entity) {
            throw new TransformationFailedException(sprintf('Object with identifier "%s" does not exist!', $uuid));
        }

        return $entity;
    }
}
