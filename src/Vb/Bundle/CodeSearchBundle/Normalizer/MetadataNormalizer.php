<?php

namespace Vb\Bundle\CodeSearchBundle\Normalizer;

use Paysera\Component\Serializer\Entity\Result;
use Paysera\Component\Serializer\Normalizer\NormalizerInterface;
use Vb\Bundle\CodeSearchBundle\Entity\Filter;

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
            'total' => (int) $result->getTotalCount(),
            'page' => (int) $filter->getPage(),
            'per_page' => (int) $filter->getPerPage(),
        ];
    }
}
