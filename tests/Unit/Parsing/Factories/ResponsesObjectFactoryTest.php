<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use AdamQ\OpenApiParser\Model\ReferenceObject;
use AdamQ\OpenApiParser\Model\ResponseObject;
use AdamQ\OpenApiParser\Model\ResponsesObject;
use AdamQ\OpenApiParser\Model\Version;
use AdamQ\OpenApiParser\Parsing\Factories\ResponsesObjectFactory;
use AdamQ\OpenApiParser\Parsing\Factory;
use AdamQ\OpenApiParser\Tests\Support\ObjectFactoryTest;
use AdamQ\OpenApiParser\Tests\Support\SpecificationExtensionsObjectFactoryTest;

#[CoversClass(ResponsesObject::class)]
#[CoversClass(ResponsesObjectFactory::class)]
final class ResponsesObjectFactoryTest extends TestCase
{
    use ObjectFactoryTest;
    use SpecificationExtensionsObjectFactoryTest;

    protected function setupPreconditions(Factory&MockObject $factory): void
    {
        $factory
            ->method('create')
            ->willReturnCallback(fn (string $class, ?object $data) => is_null($data) ? null : match ($class) {
                ReferenceObject::class => new ReferenceObject(ref: '#/components/responses/Response'),
                ResponseObject::class => new ResponseObject(description: 'Response')
            });
    }

    public static function examples(): iterable
    {
        yield 'default reference example' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'default' => (object) [
                    '$ref' => '#/components/responses/Response',
                ],
            ],
            'expected' => new ResponsesObject(
                items: (object) [
                    'default' => new ReferenceObject(
                        ref: '#/components/responses/Response',
                    ),
                ]
            )
        ];
        yield 'default response example' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'default' => (object) [
                    'description' => 'Response',
                ],
            ],
            'expected' => new ResponsesObject(
                items: (object) [
                    'default' => new ResponseObject(
                        description: 'Response',
                    ),
                ]
            )
        ];
        yield 'mixed codes example' => [
            'version' => Version::V3_1,
            'data' => (object) [
                '200' => (object) [
                    'description' => 'Response',
                ],
                '201' => (object) [
                    '$ref' => '#/components/responses/Response',
                ],
            ],
            'expected' => new ResponsesObject(
                items: (object) [
                    '200' => new ResponseObject(
                        description: 'Response',
                    ),
                    '201' => new ReferenceObject(
                        ref: '#/components/responses/Response',
                    ),
                ]
            )
        ];
    }
}
