<?php

namespace Tests\CodeSearchBundle\Controller;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Client as GuzzleClient;
use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;

class SearchApiControllerTest extends WebTestCase
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var RouterInterface
     */
    private $router;

    protected function setUp()
    {
        $this->client = $this->createClient();
        $this->router = $this->client->getContainer()->get('router');

        $this->overrideGuzzleClient($this->client->getContainer());
    }

    public function testSearchCode()
    {
        $this->client->request(
            Request::METHOD_GET,
            $this->router->generate('vb_code_search.search_api'),
            ['term' => 'test']
        );

        $response = $this->client->getResponse();
        $data = json_decode($response->getContent(), true);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertArrayHasKey('items', $data);
        $this->assertCount(1, $data['items']);

        $item = $data['items'][0];
        $this->assertArrayHasKey('repository_name', $item);
        $this->assertArrayHasKey('owner_name', $item);
        $this->assertArrayHasKey('file_name', $item);
        $this->assertSame('test_repo', $item['repository_name']);
        $this->assertSame('test_owner', $item['owner_name']);
        $this->assertSame('test_path', $item['file_name']);
    }

    private function overrideGuzzleClient(ContainerInterface $container)
    {
        $mockData = [
            'total_count' => 1,
            'items' => [
                [
                    'repository' => [
                        'full_name' => 'test_repo',
                        'owner' => ['login' => 'test_owner'],
                    ],
                    'path' => 'test_path',
                ],
            ]
        ];

        $handler = HandlerStack::create(new MockHandler([
            new Response(200, [], json_encode($mockData)),
        ]));
        $client = new GuzzleClient(['handler' => $handler]);
        $container->set('vb_code_search.github.guzzle_client', $client);
    }
}
