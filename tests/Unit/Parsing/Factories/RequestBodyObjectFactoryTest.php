<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use AdamQ\OpenApiParser\Model\MediaTypeObjectMap;
use AdamQ\OpenApiParser\Model\RequestBodyObject;
use AdamQ\OpenApiParser\Model\Version;
use AdamQ\OpenApiParser\Parsing\Factories\RequestBodyObjectFactory;
use AdamQ\OpenApiParser\Parsing\Factory;
use AdamQ\OpenApiParser\Tests\Support\ObjectFactoryTest;
use AdamQ\OpenApiParser\Tests\Support\SpecificationExtensionsObjectFactoryTest;

#[CoversClass(RequestBodyObject::class)]
#[CoversClass(RequestBodyObjectFactory::class)]
final class RequestBodyObjectFactoryTest extends TestCase
{
    use ObjectFactoryTest;
    use SpecificationExtensionsObjectFactoryTest;

    protected function setupPreconditions(Factory&MockObject $factory): void
    {
        $factory
            ->method('create')
            ->willReturnCallback(fn (string $class, ?object $data) => is_null($data) ? null : match ($class) {
                MediaTypeObjectMap::class => new MediaTypeObjectMap(items: (object) []),
            });
    }

    public static function examples(): iterable
    {
        yield 'example from spec @3.1' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'description' => 'user to add to the system',
                'content' => (object) [],
            ],
            'expected' => new RequestBodyObject(
                content: new MediaTypeObjectMap(items: (object) []),
                description: 'user to add to the system',
                required: false,
            ),
        ];

        yield 'override required to true @3.1' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'description' => 'user to add to the system',
                'content' => (object) [],
                'required' => true,
            ],
            'expected' => new RequestBodyObject(
                content: new MediaTypeObjectMap(items: (object) []),
                description: 'user to add to the system',
                required: true,
            ),
        ];
    }
}
