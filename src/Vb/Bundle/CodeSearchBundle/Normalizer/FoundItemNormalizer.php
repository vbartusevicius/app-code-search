<?php

namespace Vb\Bundle\CodeSearchBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vb\Bundle\CodeSearchBundle\Entity\FoundItem;

class FoundItemNormalizer implements NormalizerInterface
{
    /**
     * @param FoundItem $entity
     *
     * @return array
     */
    public function mapFromEntity($entity)
    {
        return [
            'repository_name' => $entity->getRepositoryName(),
            'owner_name' => $entity->getOwnerName(),
            'file_name' => $entity->getFileName(),
        ];
    }
}
