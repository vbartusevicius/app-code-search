<?php

namespace Vb\Bundle\CodeSearchBundle\Service;

use Vb\Bundle\CodeSearchBundle\Service\SearchHandler\SearchHandlerInterface;

class SearchManager
{
    public function __construct(SearchHandlerInterface $codeProvider)
    {
    }
}
