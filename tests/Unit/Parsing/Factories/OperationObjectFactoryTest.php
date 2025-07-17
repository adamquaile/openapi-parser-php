<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use TypeSlow\OpenApiParser\Model\HeaderObjectExamplesMap;
use TypeSlow\OpenApiParser\Model\MediaTypeObject;
use TypeSlow\OpenApiParser\Model\MediaTypeObjectMap;
use TypeSlow\OpenApiParser\Model\OAuthFlowObject;
use TypeSlow\OpenApiParser\Model\OperationObject;
use TypeSlow\OpenApiParser\Model\OperationObjectCallbacksMap;
use TypeSlow\OpenApiParser\Model\OperationObjectParametersList;
use TypeSlow\OpenApiParser\Model\ReferenceObject;
use TypeSlow\OpenApiParser\Model\RequestBodyObject;
use TypeSlow\OpenApiParser\Model\ResponsesObject;
use TypeSlow\OpenApiParser\Model\SchemaObject;
use TypeSlow\OpenApiParser\Model\SecurityRequirementObject;
use TypeSlow\OpenApiParser\Model\Version;
use TypeSlow\OpenApiParser\Parsing\Factories\OperationObjectFactory;
use TypeSlow\OpenApiParser\Parsing\Factory;
use TypeSlow\OpenApiParser\Tests\Support\ObjectFactoryTest;
use TypeSlow\OpenApiParser\Tests\Support\SpecificationExtensionsObjectFactoryTest;

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
                OperationObjectParametersList::class => new OperationObjectParametersList(items: $data->parameters ?? []),
                RequestBodyObject::class => new RequestBodyObject(content: new MediaTypeObjectMap(items: (object) [])),
                ResponsesObject::class => new ResponsesObject(items: (object) [
                    '200' => (object) ['description' => 'Pet updated.'],
                    '405' => (object) ['description' => 'Method Not Allowed'],
                ]),
                SecurityRequirementObject::class => new SecurityRequirementObject(items: $data->security ?? (object) []),
                OperationObjectCallbacksMap::class => new OperationObjectCallbacksMap(items: (object) [
                    'petUpdated' => new ReferenceObject(ref: '#/components/callbacks/petUpdated'),
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
                parameters: new OperationObjectParametersList(items: []),
                requestBody: new RequestBodyObject(content: new MediaTypeObjectMap((object) [])),
                responses: new ResponsesObject(items: (object) [
                    '200' => (object) ['description' => 'Pet updated.'],
                    '405' => (object) ['description' => 'Method Not Allowed'],
                ]),
                security: new SecurityRequirementObject(items: (object) [])
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
    }


}
