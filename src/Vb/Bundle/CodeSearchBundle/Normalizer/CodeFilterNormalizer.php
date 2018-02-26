<?php

namespace Vb\Bundle\CodeSearchBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\FilterNormalizer;
use Vb\Bundle\CodeSearchBundle\Entity\CodeFilter;

class CodeFilterNormalizer extends FilterNormalizer
{
    /**
     * @param array $data
     *
     * @return CodeFilter
     */
    public function mapToEntity($data)
    {
        $filter = new CodeFilter();

        $this->mapBaseKeys($data, $filter);

        if (isset($data['term'])) {
            $filter->setTerm($data['term']);
        }

        return $filter;
    }
}
