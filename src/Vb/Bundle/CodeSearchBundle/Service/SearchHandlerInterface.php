<?php

namespace Vb\Bundle\CodeSearchBundle\Service;

use Paysera\Component\Serializer\Entity\Result;
use Vb\Bundle\CodeSearchBundle\Entity\CodeFilter;

interface SearchHandlerInterface
{
    /**
     * @param CodeFilter $filter
     * @return Result
     */
    public function searchCode(CodeFilter $filter);
}
