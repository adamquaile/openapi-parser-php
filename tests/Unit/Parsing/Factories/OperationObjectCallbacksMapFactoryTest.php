<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use TypeSlow\OpenApiParser\Model\CallbackObject;
use TypeSlow\OpenApiParser\Model\OAuthFlowObject;
use TypeSlow\OpenApiParser\Model\OperationObjectCallbacksMap;
use TypeSlow\OpenApiParser\Model\ReferenceObject;
use TypeSlow\OpenApiParser\Model\Version;
use TypeSlow\OpenApiParser\Parsing\Factories\OperationObjectCallbacksMapFactory;
use TypeSlow\OpenApiParser\Parsing\Factory;
use TypeSlow\OpenApiParser\Tests\Support\ObjectFactoryTest;

#[CoversClass(OperationObjectCallbacksMap::class)]
#[CoversClass(OperationObjectCallbacksMapFactory::class)]
final class OperationObjectCallbacksMapFactoryTest extends TestCase
{
    use ObjectFactoryTest;

    protected function setupPreconditions(Factory&MockObject $factory): void
    {
        $factory
            ->method('create')
            ->willReturnCallback(fn (string $class, ?object $data) => is_null($data) ? null : match ($class) {
                CallbackObject::class => new CallbackObject(items: (object) []),
                ReferenceObject::class => new ReferenceObject(ref: '#/components/callbacks/success'),
            });
    }

    public static function examples(): iterable
    {
        yield 'empty example' => [
            'version' => Version::V3_1,
            'data' => (object) [],
            'expected' => new OperationObjectCallbacksMap(items: (object) []),
        ];

        yield 'callback example' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'success' => (object) [
                    'post' => (object) [],
                ],
            ],
            'expected' => new OperationObjectCallbacksMap(items: (object) [
                'success' => new CallbackObject(items: (object) []),
            ]),
        ];

        yield 'reference example' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'success' => (object) [
                    '$ref' => '#/components/callbacks/success',
                ],
            ],
            'expected' => new OperationObjectCallbacksMap(items: (object) [
                'success' => new ReferenceObject(ref: '#/components/callbacks/success'),
            ]),
        ];
    }
}
