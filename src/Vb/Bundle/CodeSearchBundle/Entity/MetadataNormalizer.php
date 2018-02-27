<?php

namespace Vb\Bundle\CodeSearchBundle\Entity;

use Paysera\Component\Serializer\Entity\Result;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;

class MetadataNormalizer implements NormalizerInterface
{
    /**
     * @param Result $result
     *
     * @return array
     */
    public function mapFromEntity($result)
    {
        /** @var Filter $filter */
        $filter = $result->getFilter();

        return [
            'total' => $result->getTotalCount(),
            'page' => $filter->getPage(),
            'per_page' => $filter->getPerPage(),
        ];
    }
}
