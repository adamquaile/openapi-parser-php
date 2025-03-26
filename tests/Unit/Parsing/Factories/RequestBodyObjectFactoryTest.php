<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use TypeSlow\OpenApiParser\Model\MediaTypeObjectMap;
use TypeSlow\OpenApiParser\Model\RequestBodyObject;
use TypeSlow\OpenApiParser\Model\Version;
use TypeSlow\OpenApiParser\Parsing\Factories\RequestBodyObjectFactory;
use TypeSlow\OpenApiParser\Parsing\Factory;
use TypeSlow\OpenApiParser\Tests\Support\ObjectFactoryTest;
use TypeSlow\OpenApiParser\Tests\Support\SpecificationExtensionsObjectFactoryTest;

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
