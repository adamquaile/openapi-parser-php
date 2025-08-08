<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use AdamQ\OpenApiParser\Model\ExamplesMap;
use AdamQ\OpenApiParser\Model\MediaTypeObject;
use AdamQ\OpenApiParser\Model\MediaTypeObjectMap;
use AdamQ\OpenApiParser\Model\OAuthFlowObject;
use AdamQ\OpenApiParser\Model\OperationObject;
use AdamQ\OpenApiParser\Model\OperationObjectCallbacksMap;
use AdamQ\OpenApiParser\Model\ParametersList;
use AdamQ\OpenApiParser\Model\ReferenceObject;
use AdamQ\OpenApiParser\Model\RequestBodyObject;
use AdamQ\OpenApiParser\Model\ResponsesObject;
use AdamQ\OpenApiParser\Model\SchemaObject;
use AdamQ\OpenApiParser\Model\SecurityRequirementObject;
use AdamQ\OpenApiParser\Model\SecurityRequirementsList;
use AdamQ\OpenApiParser\Model\ServerObject;
use AdamQ\OpenApiParser\Model\ServersList;
use AdamQ\OpenApiParser\Model\Version;
use AdamQ\OpenApiParser\Parsing\Factories\OperationObjectFactory;
use AdamQ\OpenApiParser\Parsing\Factory;
use AdamQ\OpenApiParser\Tests\Support\ObjectFactoryTest;
use AdamQ\OpenApiParser\Tests\Support\SpecificationExtensionsObjectFactoryTest;

#[CoversClass(OperationObject::class)]
#[CoversClass(OperationObjectFactory::class)]
final class OperationObjectFactoryTest extends TestCase
{
    use ObjectFactoryTest;
    use SpecificationExtensionsObjectFactoryTest;

    protected function setupPreconditions(Factory&MockObject $factory): void
    {
        $factory
            ->method('create')
            ->willReturnCallback(fn (string $class, null|object|array $data) => is_null($data) ? null : match ($class) {
                ParametersList::class => new ParametersList(items: $data->parameters ?? []),
                RequestBodyObject::class => new RequestBodyObject(content: new MediaTypeObjectMap(items: (object) [])),
                ResponsesObject::class => new ResponsesObject(items: (object) [
                    '200' => (object) ['description' => 'Pet updated.'],
                    '405' => (object) ['description' => 'Method Not Allowed'],
                ]),
                SecurityRequirementsList::class => new SecurityRequirementsList(items: [
                    new SecurityRequirementObject(items: (object) ['petstore_auth' => ['write:pets', 'read:pets']])
                ]),
                OperationObjectCallbacksMap::class => new OperationObjectCallbacksMap(items: (object) [
                    'petUpdated' => new ReferenceObject(ref: '#/components/callbacks/petUpdated'),
                ]),
                ServersList::class => new ServersList(items: [
                    new ServerObject(url: 'https://api.example.com/v1'),
                    new ServerObject(url: 'https://api.example.com/v2'),
                ]),
            });
    }

    public static function examples(): iterable
    {
        yield 'minimal example' => [
            'version' => Version::V3_1,
            'data' => (object) [],
            'expected' => new OperationObject(),
        ];

        yield 'spec example' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'tags' => ['pet'],
                'summary' => 'Updates a pet in the store with form data',
                'operationId' => 'updatePetWithForm',
                'parameters' => [
                    (object) [
                        'name' => 'petId',
                        'in' => 'path',
                        'required' => true,
                        'schema' => (object) [
                            'type' => 'string',
                        ],
                    ],
                ],
                'requestBody' => (object) [
                    'content' => (object) [
                        'application/x-www-form-urlencoded' => (object) [
                            'schema' => (object) [
                                'type' => 'object',
                                'properties' => (object) [
                                    'name' => (object) ['type' => 'string'],
                                    'status' => (object) ['type' => 'string'],
                                ],
                            ],
                        ],
                    ],
                ],
                'responses' => (object) [
                    '200' => (object) [
                        'description' => 'Pet updated.',
                    ],
                    '405' => (object) [
                        'description' => 'Method Not Allowed',
                    ],
                ],
                'security' => [
                    (object) [
                        'petstore_auth' => ['write:pets', 'read:pets'],
                    ],
                ],
            ],
            'expected' => new OperationObject(
                tags: ['pet'],
                summary: 'Updates a pet in the store with form data',
                operationId: 'updatePetWithForm',
                parameters: new ParametersList(items: []),
                requestBody: new RequestBodyObject(content: new MediaTypeObjectMap((object) [])),
                responses: new ResponsesObject(items: (object) [
                    '200' => (object) ['description' => 'Pet updated.'],
                    '405' => (object) ['description' => 'Method Not Allowed'],
                ]),
                security: new SecurityRequirementsList(items: [
                    new SecurityRequirementObject(items: (object) ['petstore_auth' => ['write:pets', 'read:pets']])
                ])
            ),
        ];

        yield 'callbacks example' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'callbacks' => (object) [
                    'petUpdated' => (object) [
                        '$ref' => '#/components/callbacks/petUpdated',
                    ],
                ]
            ],
            'expected' => new OperationObject(
                callbacks: new OperationObjectCallbacksMap(items: (object) [
                    'petUpdated' => new ReferenceObject(ref: '#/components/callbacks/petUpdated'),
                ])
            ),
        ];

        yield 'servers example' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'servers' => [
                    (object) ['url' => 'https://api.example.com/v1'],
                    (object) ['url' => 'https://api.example.com/v2'],
                ]
            ],
            'expected' => new OperationObject(
                servers: new ServersList(items: [
                    new ServerObject(url: 'https://api.example.com/v1'),
                    new ServerObject(url: 'https://api.example.com/v2'),
                ])
            ),
        ];
    }
}
