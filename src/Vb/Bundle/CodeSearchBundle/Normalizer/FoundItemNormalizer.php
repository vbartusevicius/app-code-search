<?php

namespace Vb\Bundle\CodeSearchBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vb\Bundle\CodeSearchBundle\Entity\FoundItem;

class FoundItemNormalizer implements NormalizerInterface, DenormalizerInterface
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

    /**
     * @param array $data
     *
     * @return FoundItem
     */
    public function mapToEntity($data)
    {
        $item = new FoundItem();

        if (isset($data['repository_name'])) {
            $item->setRepositoryName($data['repository_name']);
        }
        if (isset($data['owner_name'])) {
            $item->setOwnerName($data['owner_name']);
        }
        if (isset($data['file_name'])) {
            $item->setFileName($data['file_name']);
        }

        return $item;
    }
}
