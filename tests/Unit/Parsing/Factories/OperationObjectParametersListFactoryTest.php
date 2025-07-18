<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use TypeSlow\OpenApiParser\Model\OperationObjectParametersList;
use TypeSlow\OpenApiParser\Model\ParameterObject;
use TypeSlow\OpenApiParser\Model\ReferenceObject;
use TypeSlow\OpenApiParser\Model\Version;
use TypeSlow\OpenApiParser\Parsing\Factories\OperationObjectParametersListFactory;
use TypeSlow\OpenApiParser\Parsing\Factory;
use TypeSlow\OpenApiParser\Tests\Support\ObjectFactoryTest;

#[CoversClass(OperationObjectParametersList::class)]
#[CoversClass(OperationObjectParametersListFactory::class)]
final class OperationObjectParametersListFactoryTest extends TestCase
{
    use ObjectFactoryTest;

    public function setupPreconditions(MockObject&Factory $factory): void
    {
        $factory
            ->method('create')
            ->willReturnCallback(fn (string $class, ?object $data) => is_null($data) ? null : match ($class) {
                ParameterObject::class => new ParameterObject(name: 'token', in: 'query'),
                ReferenceObject::class => new ReferenceObject(ref: '#/components/parameters/token'),
            });
    }


    public static function examples(): iterable
    {
        yield 'empty example' => [
            'version' => Version::V3_1,
            'data' => [],
            'expected' => new OperationObjectParametersList(items: []),
        ];

        yield 'parameter object example' => [
            'version' => Version::V3_1,
            'data' => [
                (object) [
                    'name' => 'token',
                    'in' => 'query',
                ],
            ],
            'expected' => new OperationObjectParametersList(items: [
                new ParameterObject(
                    name: 'token',
                    in: 'query',
                )
            ]),
        ];


        yield 'reference object example' => [
            'version' => Version::V3_1,
            'data' => [
                (object) [
                    '$ref' => '#/components/parameters/token',
                ],
            ],
            'expected' => new OperationObjectParametersList(items: [
                new ReferenceObject(ref: '#/components/parameters/token'),
            ]),
        ];

        yield 'multiple example' => [
            'version' => Version::V3_1,
            'data' => [
                (object) [
                    'name' => 'token',
                    'in' => 'query',
                ],
                (object) [
                    '$ref' => '#/components/parameters/token',
                ],
            ],
            'expected' => new OperationObjectParametersList(items: [
                new ParameterObject(
                    name: 'token',
                    in: 'query',
                ),
                new ReferenceObject(ref: '#/components/parameters/token'),
            ]),
        ];
    }


}