<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use AdamQ\OpenApiParser\Model\ParametersList;
use AdamQ\OpenApiParser\Model\ParameterObject;
use AdamQ\OpenApiParser\Model\ReferenceObject;
use AdamQ\OpenApiParser\Model\Version;
use AdamQ\OpenApiParser\Parsing\Factories\ParametersListFactory;
use AdamQ\OpenApiParser\Parsing\Factory;
use AdamQ\OpenApiParser\Tests\Support\ObjectFactoryTest;

#[CoversClass(ParametersList::class)]
#[CoversClass(ParametersListFactory::class)]
final class ParametersListFactoryTest extends TestCase
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
            'expected' => new ParametersList(items: []),
        ];

        yield 'parameter object example' => [
            'version' => Version::V3_1,
            'data' => [
                (object) [
                    'name' => 'token',
                    'in' => 'query',
                ],
            ],
            'expected' => new ParametersList(items: [
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
            'expected' => new ParametersList(items: [
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
            'expected' => new ParametersList(items: [
                new ParameterObject(
                    name: 'token',
                    in: 'query',
                ),
                new ReferenceObject(ref: '#/components/parameters/token'),
            ]),
        ];
    }


}