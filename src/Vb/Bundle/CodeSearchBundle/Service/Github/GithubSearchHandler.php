<?php

namespace Vb\Bundle\CodeSearchBundle\Service\Github;

use Paysera\Component\Serializer\Entity\Result;
use Vb\Bundle\CodeSearchBundle\Entity\CodeFilter;
use Vb\Bundle\CodeSearchBundle\Normalizer\FoundItemNormalizer;
use Vb\Bundle\CodeSearchBundle\Service\SearchHandlerInterface;

class GithubSearchHandler implements SearchHandlerInterface
{
    private $client;
    private $foundItemNormalizer;

    public function __construct(
        GithubClient $client,
        FoundItemNormalizer $foundItemNormalizer
    ) {
        $this->client = $client;
        $this->foundItemNormalizer = $foundItemNormalizer;
    }

    /**
     * @param CodeFilter $filter
     * @return Result
     */
    public function searchCode(CodeFilter $filter)
    {
        $data = $this->client->byCode($filter->getTerm(), $filter);

        $result = new Result();
        $result
            ->setTotalCount($data['total'])
            ->setFilter($filter)
        ;

        foreach ($data['items'] as $itemData) {
            $foundItem = $this->foundItemNormalizer->mapToEntity([
                'repository_name' => $itemData['repository']['full_name'],
                'owner_name' => $itemData['repository']['owner']['login'],
                'file_name' => $itemData['path'],
            ]);
            $result->addItem($foundItem);
        }

        return $result;
    }
}
