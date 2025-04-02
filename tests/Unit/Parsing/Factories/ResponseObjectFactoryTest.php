<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use TypeSlow\OpenApiParser\Model\HeaderObjectMap;
use TypeSlow\OpenApiParser\Model\LinkObjectMap;
use TypeSlow\OpenApiParser\Model\MediaTypeObjectMap;
use TypeSlow\OpenApiParser\Model\ResponseObject;
use TypeSlow\OpenApiParser\Model\Version;
use TypeSlow\OpenApiParser\Parsing\Factories\ResponseObjectFactory;
use TypeSlow\OpenApiParser\Parsing\Factory;
use TypeSlow\OpenApiParser\Tests\Support\ObjectFactoryTest;
use TypeSlow\OpenApiParser\Tests\Support\SpecificationExtensionsObjectFactoryTest;

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
