<?php

namespace Vb\Bundle\GithubSearchBundle\Service;

use GuzzleHttp\ClientInterface;
use Paysera\Component\Serializer\Entity\Result;
use Vb\Bundle\CodeSearchBundle\Entity\CodeFilter;
use Vb\Bundle\CodeSearchBundle\Service\SearchHandler\SearchHandlerInterface;

class GithubSearchHandler implements SearchHandlerInterface
{
    const MAX_PER_PAGE = 100;

    private $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param CodeFilter $codeFilter
     * @return Result
     */
    public function searchCode(CodeFilter $codeFilter)
    {
        // TODO: Implement searchCode() method.
    }
}
