<?php

namespace Vb\Bundle\CodeSearchBundle\Service\Github;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\TransferException;
use Symfony\Component\HttpFoundation\Request;
use Vb\Bundle\CodeSearchBundle\Entity\Filter;
use Vb\Bundle\CodeSearchBundle\Exception\InvalidParametersException;
use Vb\Bundle\CodeSearchBundle\Exception\SearchHandlerException;

class GithubClient
{
    const MAX_PER_PAGE = 100;

    private $client;

    public function __construct(
        ClientInterface $client
    ) {
        $this->client = $client;
    }

    /**
     * @param string $term
     * @param Filter $filter
     * @return array
     *
     * @throws InvalidParametersException
     * @throws SearchHandlerException
     */
    public function byCode($term, Filter $filter)
    {
        try {
            return $this->sendRequest(
                Request::METHOD_GET,
                sprintf('code?q=%s', urlencode($term)),
                $filter
            );
        } catch (ClientException $clientException) {
            throw new InvalidParametersException('Some search parameters are invalid', 0, $clientException);
        } catch (ServerException $serverException) {
            throw new SearchHandlerException('Got exception from Github server', 0, $serverException);
        } catch (TransferException $transferException) {
            throw new SearchHandlerException('Got error while executing Request', 0, $transferException);
        }
    }

    /**
     * @param string $method
     * @param string $uri
     * @param Filter $filter
     * @return array
     */
    private function sendRequest($method, $uri, Filter $filter)
    {
        $itemsLeft = $filter->getPerPage();
        $copy = clone $filter;
        $filteredUri = sprintf('%s&%s', $uri, $this->buildFilter($copy));

        $total = 0;
        $items = [];

        do {
            $response = $this->client->request($method, $filteredUri);
            $data = json_decode($response->getBody()->getContents(), true);

            $total = $data['total_count'];
            $items += $data['items'];

            $copy->setPage($copy->getPage() + 1);
            $copy->setPerPage($copy->getPerPage());

            if ($itemsLeft > self::MAX_PER_PAGE) {
                $copy->setPerPage(self::MAX_PER_PAGE);
            } else {
                $copy->setPerPage($itemsLeft);
            }
            $itemsLeft -= self::MAX_PER_PAGE;
        } while ($itemsLeft > 0);

        return ['total' => $total, 'items' => $items];
    }

    private function buildFilter(Filter $filter)
    {
        $filterParams = [
            'sort' => $filter->getOrderBy(),
            'order' => $filter->getOrderDirection(),
            'page' => $filter->getPage(),
            'per_page' => $filter->getPerPage(),
        ];

        return http_build_query(array_filter($filterParams));
    }
}
