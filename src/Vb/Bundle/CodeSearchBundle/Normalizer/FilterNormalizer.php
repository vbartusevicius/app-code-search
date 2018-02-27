<?php

namespace Vb\Bundle\CodeSearchBundle\Normalizer;

use Paysera\Component\Serializer\Normalizer\DenormalizerInterface;
use Vb\Bundle\CodeSearchBundle\Entity\Filter;

class FilterNormalizer implements DenormalizerInterface
{
    /**
     * @param array $data
     *
     * @return Filter
     */
    public function mapToEntity($data)
    {
        $filter = new Filter();

        $this->mapBaseKeys($filter, $data);

        return $filter;
    }

    protected function mapBaseKeys(Filter $filter, array $data)
    {
        if (isset($data['page'])) {
            $filter->setPage($data['page']);
        }
        if (isset($data['per_page'])) {
            $filter->setPerPage($data['per_page']);
        }
        if (isset($data['order_by'])) {
            $filter->setOrderBy($data['order_by']);
        }
        if (isset($data['order_direction'])) {
            $filter->setOrderDirection($data['order_direction']);
        }
    }
}
