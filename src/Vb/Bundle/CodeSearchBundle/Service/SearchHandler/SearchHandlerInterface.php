<?php

namespace Vb\Bundle\CodeSearchBundle\Service\SearchHandler;

use Paysera\Component\Serializer\Entity\Result;
use Vb\Bundle\CodeSearchBundle\Entity\CodeFilter;

interface SearchHandlerInterface
{
    /**
     * @param CodeFilter $codeFilter
     * @return Result
     */
    public function searchCode(CodeFilter $codeFilter);
}
