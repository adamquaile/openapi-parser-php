<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use TypeSlow\OpenApiParser\Exceptions\InvalidOpenApiDocument;
use TypeSlow\OpenApiParser\Exceptions\OpenApiValidationError;
use TypeSlow\OpenApiParser\Model\InfoObject;
use TypeSlow\OpenApiParser\Model\Version;
use TypeSlow\OpenApiParser\Model\OpenApiObject;
use TypeSlow\OpenApiParser\Model\ServersList;
use TypeSlow\OpenApiParser\Model\ServerObject;
use TypeSlow\OpenApiParser\Model\SecurityRequirementsList;
use TypeSlow\OpenApiParser\Model\SecurityRequirementObject;
use TypeSlow\OpenApiParser\Model\TagsList;
use TypeSlow\OpenApiParser\Model\TagObject;
use TypeSlow\OpenApiParser\Model\ExternalDocumentationObject;
use TypeSlow\OpenApiParser\Model\ComponentsObject;
use TypeSlow\OpenApiParser\Model\PathsObject;
use TypeSlow\OpenApiParser\Tests\Support\ObjectFactoryTest;
use TypeSlow\OpenApiParser\Parsing\DocumentPath;
use TypeSlow\OpenApiParser\Parsing\Factories\OpenApiObjectFactory;
use TypeSlow\OpenApiParser\Parsing\Factory;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

#[CoversClass(OpenApiObject::class)]
#[CoversClass(OpenApiObjectFactory::class)]
final class OpenApiObjectFactoryTest extends TestCase
{
    use ObjectFactoryTest;

    protected function setupPreconditions(Factory&MockObject $factory): void
    {
        $factory
            ->method('create')
            ->willReturnCallback(fn (string $class, null|object|array $data) => is_null($data) ? null : match ($class) {
                InfoObject::class => new InfoObject(title: $data->title, version: $data->version, description: $data->description ?? null),
                ServersList::class => new ServersList(items: [
                    new ServerObject(url: 'https://api.example.com'),
                    new ServerObject(url: 'https://staging.api.example.com'),
                ]),
                PathsObject::class => new PathsObject(items: (object) [
                    '/pets' => (object) ['get' => (object) ['operationId' => 'listPets']],
                ]),
                ComponentsObject::class => new ComponentsObject(x: new \stdClass()),
                SecurityRequirementsList::class => new SecurityRequirementsList(items: [
                    new SecurityRequirementObject(items: (object) ['api_key' => []]),
                    new SecurityRequirementObject(items: (object) ['oauth2' => ['read', 'write']]),
                ]),
                TagsList::class => new TagsList(items: [
                    new TagObject(name: 'pets'),
                    new TagObject(name: 'users'),
                ]),
                ExternalDocumentationObject::class => new ExternalDocumentationObject(
                    url: 'https://example.com/docs',
                    description: 'Find more info here'
                ),
            });
    }

    public function testPathsIsRequiredIn3Point0(): void
    {
        $mockFactory = $this->createMock(Factory::class);
        $this->setupPreconditions($mockFactory);
        
        $this->expectExceptionObject(
            new OpenApiValidationError(
                path: new DocumentPath(),
                error: 'OpenAPI 3.0 documents must contain a `paths` property'
            )
        );
        
        $this->factory->create(
            (object) [
                'openapi' => '3.0.0',
                'info' => (object) [
                    'title' => 'Minimal API',
                    'version' => '1.0.0',
                ],
            ],
            new ParseContext(Version::V3_0, $mockFactory)
        );
    }

    public static function examples(): iterable
    {
        yield 'minimal 3.1 example' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'openapi' => '3.1.0',
                'info' => (object) [
                    'title' => 'Minimal API',
                    'version' => '1.0.0',
                ],
            ],
            'expected' => new OpenApiObject(
                openapi: '3.1.0',
                info: new InfoObject(title: 'Minimal API', version: '1.0.0'),
            ),
        ];

        yield 'minimal 3.0 example' => [
            'version' => Version::V3_0,
            'data' => (object) [
                'openapi' => '3.0.0',
                'info' => (object) [
                    'title' => 'Minimal API',
                    'version' => '1.0.0',
                ],
                'paths' => (object) [],
            ],
            'expected' => new OpenApiObject(
                openapi: '3.0.0',
                info: new InfoObject(title: 'Minimal API', version: '1.0.0'),
                paths: new PathsObject(items: (object) ['/pets' => (object) ['get' => (object) ['operationId' => 'listPets']]]),
            ),
        ];

        yield 'full example' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'openapi' => '3.1.0',
                'info' => (object) [
                    'title' => 'Complete API',
                    'version' => '2.0.0',
                    'description' => 'A complete API example',
                ],
                'jsonSchemaDialect' => 'https://json-schema.org/draft/2020-12/schema',
                'servers' => [
                    (object) ['url' => 'https://api.example.com'],
                    (object) ['url' => 'https://staging.api.example.com'],
                ],
                'paths' => (object) [
                    '/pets' => (object) [
                        'get' => (object) [
                            'operationId' => 'listPets',
                        ],
                    ],
                ],
                'components' => (object) [],
                'security' => [
                    (object) ['api_key' => []],
                    (object) ['oauth2' => ['read', 'write']],
                ],
                'tags' => [
                    (object) ['name' => 'pets'],
                    (object) ['name' => 'users'],
                ],
                'externalDocs' => (object) [
                    'description' => 'Find more info here',
                    'url' => 'https://example.com/docs',
                ],
            ],
            'expected' => new OpenApiObject(
                openapi: '3.1.0',
                info: new InfoObject(title: 'Complete API', version: '2.0.0', description: 'A complete API example'),
                jsonSchemaDialect: 'https://json-schema.org/draft/2020-12/schema',
                servers: new ServersList(items: [
                    new ServerObject(url: 'https://api.example.com'),
                    new ServerObject(url: 'https://staging.api.example.com'),
                ]),
                paths: new PathsObject(items: (object) ['/pets' => (object) ['get' => (object) ['operationId' => 'listPets']]]),
                components: new ComponentsObject(x: new \stdClass()),
                security: new SecurityRequirementsList(items: [
                    new SecurityRequirementObject(items: (object) ['api_key' => []]),
                    new SecurityRequirementObject(items: (object) ['oauth2' => ['read', 'write']]),
                ]),
                tags: new TagsList(items: [
                    new TagObject(name: 'pets'),
                    new TagObject(name: 'users'),
                ]),
                externalDocs: new ExternalDocumentationObject(
                    url: 'https://example.com/docs',
                    description: 'Find more info here'
                ),
            ),
        ];

        yield 'servers example' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'openapi' => '3.1.0',
                'info' => (object) [
                    'title' => 'API with servers',
                    'version' => '1.0.0',
                ],
                'servers' => [
                    (object) ['url' => 'https://api.example.com'],
                ],
            ],
            'expected' => new OpenApiObject(
                openapi: '3.1.0',
                info: new InfoObject(title: 'API with servers', version: '1.0.0'),
                servers: new ServersList(items: [
                    new ServerObject(url: 'https://api.example.com'),
                    new ServerObject(url: 'https://staging.api.example.com'),
                ]),
            ),
        ];

        yield 'jsonSchemaDialect example' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'openapi' => '3.1.0',
                'info' => (object) [
                    'title' => 'API with JSON Schema Dialect',
                    'version' => '1.0.0',
                ],
                'jsonSchemaDialect' => 'https://json-schema.org/draft/2020-12/schema',
            ],
            'expected' => new OpenApiObject(
                openapi: '3.1.0',
                info: new InfoObject(title: 'API with JSON Schema Dialect', version: '1.0.0'),
                jsonSchemaDialect: 'https://json-schema.org/draft/2020-12/schema',
            ),
        ];
    }
}
