<?php

namespace Vb\Bundle\CodeSearchBundle\Controller;

use Paysera\Bundle\RestBundle\Exception\ApiException;
use Psr\Log\LoggerInterface;
use Vb\Bundle\CodeSearchBundle\Entity\CodeFilter;
use Vb\Bundle\CodeSearchBundle\Exception\InvalidParametersException;
use Vb\Bundle\CodeSearchBundle\Exception\SearchHandlerException;
use Vb\Bundle\CodeSearchBundle\Service\SearchManager;

class SearchApiController
{
    private $searchManager;
    private $logger;

    public function __construct(
        SearchManager $searchManager,
        LoggerInterface $logger
    ) {
        $this->searchManager = $searchManager;
        $this->logger = $logger;
    }

    public function searchCode(CodeFilter $filter)
    {
        try {
            return $this->searchManager->searchCode($filter);
        } catch (InvalidParametersException $parametersException) {
            $this->logger->error('Invalid search parameters', [$parametersException]);
            throw new ApiException(
                ApiException::INVALID_PARAMETERS,
                'Invalid search parameters'
            );
        } catch (SearchHandlerException $searchHandlerException) {
            $this->logger->error('Error while searching', [$searchHandlerException]);
            throw new ApiException(
                ApiException::INTERNAL_SERVER_ERROR,
                'Error while searching'
            );
        }
    }
}
