<?php

namespace Vb\Bundle\CodeSearchBundle\Normalizer;

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

        $this->mapBaseKeys($filter, $data);

        if (isset($data['term'])) {
            $filter->setTerm($data['term']);
        }

        return $filter;
    }
}
