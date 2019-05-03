<?php

namespace Lettingbox\Vorensys\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use Lettingbox\Vorensys\Exceptions\VorensysException;
use Lettingbox\Vorensys\Vorensys;
use Lettingbox\Vorensys\Application;
use PHPUnit\Framework\TestCase;

class VorensysTest extends TestCase
{
    private $historyContainer;

    public function setUp(): void
    {
        parent::setUp();
        $this->historyContainer = [];
    }

    /** @test */
    public function returns_vorensys_exception_when_cannot_connect()
    {
        $this->expectException(VorensysException::class);

        $client = $this->createFakeClient([
            new Response(500, [], json_encode([
                'status' => '400',
                'message' => 'submit',
                'Validation Failure(s)' => ['ren_prop_postcode' => 'Enter a valid postcode'],
            ])),
        ]);

        $vorensys = new Vorensys($client);
        $vorensys->submit(new Application('Mr.', 'John', 'Doe', 'human@world.com'));
    }

    /** @test */
    public function returns_vorensys_exception_when_error_received()
    {
        $this->expectException(VorensysException::class);

        $client = $this->createFakeClient([
            new Response(200, [], json_encode([
                'status' => '400',
                'message' => 'submit',
                'Validation Failure(s)' => ['ren_prop_postcode' => 'Enter a valid postcode'],
            ])),
        ]);

        $vorensys = new Vorensys($client);
        $vorensys->submit(new Application('Mr.', 'John', 'Doe', 'human@world.com'));
    }

    /** @test */
    public function returns_an_array_if_successful()
    {
        $client = $this->createFakeClient([
            new Response(200, [], json_encode([
                'status' => '200',
                'message' => 'submit',
                'job number' => 'V-VOR171204ZVY',
                'tenant form URL' => 'https://www.vorensys.com/tg.php?urlKey=31xnzy96svrdfbpg'
            ])),
        ]);

        $vorensys = new Vorensys($client);
        $results = $vorensys->submit(new Application('Mr.', 'John', 'Doe', 'human@world.com'));

        $this->assertEquals('V-VOR171204ZVY', $results['id']);
        $this->assertEquals('https://www.vorensys.com/tg.php?urlKey=31xnzy96svrdfbpg', $results['url']);
    }

    private function createFakeClient(array $responses)
    {
        $mock = new MockHandler($responses);
        $handler = HandlerStack::create($mock);
        $handler->push(Middleware::history($this->historyContainer));
        return new Client(['handler' => $handler]);
    }
}
