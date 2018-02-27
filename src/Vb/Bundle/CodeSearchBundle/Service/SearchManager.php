<?php

namespace Vb\Bundle\CodeSearchBundle\Service;

use Vb\Bundle\CodeSearchBundle\Entity\CodeFilter;

class SearchManager
{
    private $searchHandler;

    public function __construct(SearchHandlerInterface $searchHandler)
    {
        $this->searchHandler = $searchHandler;
    }

    public function searchCode(CodeFilter $filter)
    {
        return $this->searchHandler->searchCode($filter);
    }
}
