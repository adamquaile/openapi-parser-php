<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use AdamQ\OpenApiParser\Model\CallbackObject;
use AdamQ\OpenApiParser\Model\MediaTypeObject;
use AdamQ\OpenApiParser\Model\MediaTypeObjectMap;
use AdamQ\OpenApiParser\Model\OperationObject;
use AdamQ\OpenApiParser\Model\PathItemObject;
use AdamQ\OpenApiParser\Model\ReferenceObject;
use AdamQ\OpenApiParser\Model\RequestBodyObject;
use AdamQ\OpenApiParser\Model\ResponsesObject;
use AdamQ\OpenApiParser\Model\SchemaObject;
use AdamQ\OpenApiParser\Model\Version;
use AdamQ\OpenApiParser\Parsing\Factories\CallbackObjectFactory;
use AdamQ\OpenApiParser\Parsing\Factory;
use AdamQ\OpenApiParser\Tests\Support\ObjectFactoryTest;
use AdamQ\OpenApiParser\Tests\Support\SpecificationExtensionsObjectFactoryTest;

#[CoversClass(CallbackObject::class)]
#[CoversClass(CallbackObjectFactory::class)]
final class CallbackObjectFactoryTest extends TestCase
{
    use ObjectFactoryTest;
    use SpecificationExtensionsObjectFactoryTest;

    protected function setupPreconditions(Factory&MockObject $factory): void
    {
        $factory
            ->method('create')
            ->willReturnCallback(fn (string $class, ?object $data) => is_null($data) ? null : match ($class) {
                PathItemObject::class => new PathItemObject(
                    post: new OperationObject(
                        description: 'callback payload',
                        requestBody: new RequestBodyObject(
                            content: new MediaTypeObjectMap((object) [
                                'application/json' => new MediaTypeObject(
                                    schema: new SchemaObject(
                                        dynamic: (object) ['$ref' => '#/components/schemas/SomePayload'],
                                    ),
                                ),
                            ]),
                        ),
                        responses: new ResponsesObject(items: (object) [
                            '200' => (object) ['description' => 'callback successfully processed'],
                        ]),
                    ),
                ),
                ReferenceObject::class => new ReferenceObject(ref: '#/components/callbacks/Callback'),
            });
    }

    public static function examples(): iterable
    {
        yield 'PathItemObject with key from query string in url example' => [
            'version' => Version::V3_1,
            'data' => (object) [
                '{$request.query.queryUrl}' => (object) [
                    'post' => (object) [
                        'requestBody' => (object) [
                            'description' => 'Callback payload',
                            'content' => (object) [
                                'application/json' => (object) [
                                    'schema' => (object) [
                                        '$ref' => '#/components/schemas/SomePayload',
                                    ],
                                ],
                            ],
                        ],
                        'responses' => (object) [
                            '200' => (object) [
                                'description' => 'callback successfully processed',
                            ],
                        ]
                    ]
                ],
            ],
            'expected' => new CallbackObject(items: (object) [
                '{$request.query.queryUrl}' => new PathItemObject(
                    post: new OperationObject(
                        description: 'callback payload',
                        requestBody: new RequestBodyObject(
                            content: new MediaTypeObjectMap((object) [
                                'application/json' => new MediaTypeObject(
                                    schema: new SchemaObject(
                                        dynamic: (object) ['$ref' => '#/components/schemas/SomePayload'],
                                    ),
                                ),
                            ]),
                        ),
                        responses: new ResponsesObject(items: (object) [
                            '200' => (object) ['description' => 'callback successfully processed'],
                        ]),
                    ),
                ),
            ]),
        ];

        yield 'ReferenceObject with fixed url example' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'https://example.com/callback' => (object) [
                    '$ref' => '#/components/callbacks/Callback',
                ],
            ],
            'expected' => new CallbackObject(items: (object) [
                'https://example.com/callback' => new ReferenceObject(ref: '#/components/callbacks/Callback'),
            ]),
        ];
    }
}
