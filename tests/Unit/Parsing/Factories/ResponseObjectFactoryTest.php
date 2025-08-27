<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use AdamQ\OpenApiParser\Model\HeaderObjectMap;
use AdamQ\OpenApiParser\Model\LinkObjectMap;
use AdamQ\OpenApiParser\Model\MediaTypeObjectMap;
use AdamQ\OpenApiParser\Model\ResponseObject;
use AdamQ\OpenApiParser\Model\Version;
use AdamQ\OpenApiParser\Parsing\Factories\ResponseObjectFactory;
use AdamQ\OpenApiParser\Parsing\Factory;
use AdamQ\OpenApiParser\Tests\Support\ObjectFactoryTest;
use AdamQ\OpenApiParser\Tests\Support\SpecificationExtensionsObjectFactoryTest;

#[CoversClass(ResponseObject::class)]
#[CoversClass(ResponseObjectFactory::class)]
final class ResponseObjectFactoryTest extends TestCase
{
    use ObjectFactoryTest;
    use SpecificationExtensionsObjectFactoryTest;

    protected function setupPreconditions(Factory&MockObject $factory): void
    {
        $factory
            ->method('create')
            ->willReturnCallback(fn (string $class, ?object $data) => is_null($data) ? null : match ($class) {
                MediaTypeObjectMap::class => new MediaTypeObjectMap(items: (object) []),
                HeaderObjectMap::class => new HeaderObjectMap(items: (object) []),
                LinkObjectMap::class => new LinkObjectMap(items: (object) []),
            });
    }

    public static function examples(): iterable
    {
        yield 'minimal example' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'description' => 'A simple string response',
            ],
            'expected' => new ResponseObject(
                description: 'A simple string response',
            )
        ];
        yield 'full example' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'description' => 'A simple string response',
                'content' => (object) [
                    'application/json' => (object) [
                        'schema' => (object) [
                            'type' => 'string',
                        ],
                    ],
                ],
                'headers' => (object) [
                    'X-Rate-Limit-Limit' => (object) ['description' => 'The number of allowed requests in the current period'],
                    'X-Rate-Limit-Remaining' => (object) ['description' => 'The number of remaining requests in the current period'],
                ],
                'links' => (object) [
                    'self' => (object) ['operationId' => 'get'],
                ],
            ],
            'expected' => new ResponseObject(
                description: 'A simple string response',
                headers: new HeaderObjectMap(items: (object) []),
                content: new MediaTypeObjectMap(items: (object) []),
                links: new LinkObjectMap(items: (object) []),
            )
        ];
    }
}
