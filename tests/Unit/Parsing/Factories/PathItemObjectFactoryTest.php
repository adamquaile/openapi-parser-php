<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use AdamQ\OpenApiParser\Model\OperationObject;
use AdamQ\OpenApiParser\Model\ParametersList;
use AdamQ\OpenApiParser\Model\PathItemObject;
use AdamQ\OpenApiParser\Model\ServersList;
use AdamQ\OpenApiParser\Model\Version;
use AdamQ\OpenApiParser\Parsing\Factories\PathItemObjectFactory;
use AdamQ\OpenApiParser\Parsing\Factory;
use AdamQ\OpenApiParser\Tests\Support\ObjectFactoryTest;
use AdamQ\OpenApiParser\Tests\Support\SpecificationExtensionsObjectFactoryTest;

#[CoversClass(PathItemObject::class)]
#[CoversClass(PathItemObjectFactory::class)]
final class PathItemObjectFactoryTest extends TestCase
{
    use ObjectFactoryTest;
    use SpecificationExtensionsObjectFactoryTest;

    protected function setupPreconditions(Factory&MockObject $factory): void
    {
        $factory
            ->method('create')
            ->willReturnCallback(fn (string $class, object|array|null $data) => is_null($data) ? null : match ($class) {
                OperationObject::class => new OperationObject(),
                ServersList::class => new ServersList(items: []),
                ParametersList::class => new ParametersList(items: []),
            });
    }

    public static function examples(): iterable
    {
        yield 'simple example' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'summary' => 'Pet Resource',
                'get' => (object) [],
                'post' => (object) [],
            ],
            'expected' => new PathItemObject(
                summary: 'Pet Resource',
                get: new OperationObject(),
                post: new OperationObject(),
            ),
        ];

        yield 'ref example' => [
            'version' => Version::V3_1,
            'data' => (object) [
                '$ref' => '#/components/schemas/Pet',
            ],
            'expected' => new PathItemObject(
                ref: '#/components/schemas/Pet',
            ),
        ];

        yield 'empty example' => [
            'version' => Version::V3_1,
            'data' => (object) [],
            'expected' => new PathItemObject(),
        ];

        yield 'descriptions example' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'summary' => 'Pet Resource',
                'description' => 'This path item describes operations related to pets.',
            ],
            'expected' => new PathItemObject(
                summary: 'Pet Resource',
                description: 'This path item describes operations related to pets.',
            ),
        ];

        yield 'extensive example' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'summary' => 'Pet Resource',
                'description' => 'This path item describes operations related to pets.',
                'get' => (object) [],
                'put' => (object) [],
                'post' => (object) [],
                'delete' => (object) [],
                'options' => (object) [],
                'head' => (object) [],
                'patch' => (object) [],
                'trace' => (object) [],
                'servers' => [],
                'parameters' => [],
            ],
            'expected' => new PathItemObject(
                summary: 'Pet Resource',
                description: 'This path item describes operations related to pets.',
                get: new OperationObject(),
                put: new OperationObject(),
                post: new OperationObject(),
                delete: new OperationObject(),
                options: new OperationObject(),
                head: new OperationObject(),
                patch: new OperationObject(),
                trace: new OperationObject(),
                servers: new ServersList(items: []),
                parameters: new ParametersList(items: []),
            ),
        ];
    }
}
