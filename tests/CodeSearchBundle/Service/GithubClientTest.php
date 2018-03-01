<?php

namespace Tests\CodeSearchBundle\Service;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Vb\Bundle\CodeSearchBundle\Entity\CodeFilter;
use Vb\Bundle\CodeSearchBundle\Service\Github\GithubClient;

class GithubClientTest extends TestCase
{
    /**
     * @dataProvider splittedRequestsDataProvider
     *
     * @param int $requestedItemsPerPage
     * @param int $requestCount
     * @param int $apiLimitItemsPerPage
     */
    public function test_requests_splitted_by_maximum_allowed(
        int $requestedItemsPerPage,
        int $requestCount,
        int $apiLimitItemsPerPage
    ) {
        /** @var ClientInterface|MockObject $guzzleClient */
        $guzzleClient = $this->getMockBuilder(ClientInterface::class)->getMock();
        $guzzleClient
            ->expects($this->exactly($requestCount))
            ->method('request')
            ->willReturnCallback(function () {
                return new Response(200, [], '{"total_count":0,"items":[]}');
            })
        ;

        $filter = new CodeFilter();
        $filter
            ->setPerPage($requestedItemsPerPage)
        ;

        $githubClient = new GithubClient($guzzleClient, $apiLimitItemsPerPage);
        $githubClient->byCode('test', $filter);
    }

    public function splittedRequestsDataProvider()
    {
        return [
           [12, 3, 5],
           [10, 1, 100],
        ];
    }
}
