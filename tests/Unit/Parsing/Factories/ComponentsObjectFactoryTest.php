<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use TypeSlow\OpenApiParser\Model\CallbackObjectMap;
use TypeSlow\OpenApiParser\Model\ComponentsObject;
use TypeSlow\OpenApiParser\Model\ExampleObjectMap;
use TypeSlow\OpenApiParser\Model\HeaderObjectMap;
use TypeSlow\OpenApiParser\Model\LinkObjectMap;
use TypeSlow\OpenApiParser\Model\ParameterObjectMap;
use TypeSlow\OpenApiParser\Model\PathItemObjectMap;
use TypeSlow\OpenApiParser\Model\RequestBodyObjectMap;
use TypeSlow\OpenApiParser\Model\ResponseObjectMap;
use TypeSlow\OpenApiParser\Model\SchemaObjectMap;
use TypeSlow\OpenApiParser\Model\SecuritySchemeObjectMap;
use TypeSlow\OpenApiParser\Model\Version;
use TypeSlow\OpenApiParser\Parsing\Factories\ComponentsObjectFactory;
use TypeSlow\OpenApiParser\Parsing\Factory;
use TypeSlow\OpenApiParser\Tests\Support\ObjectFactoryTest;
use TypeSlow\OpenApiParser\Tests\Support\SpecificationExtensionsObjectFactoryTest;

#[CoversClass(ComponentsObject::class)]
#[CoversClass(ComponentsObjectFactory::class)]
final class ComponentsObjectFactoryTest extends TestCase
{
    use ObjectFactoryTest;
    use SpecificationExtensionsObjectFactoryTest;

    protected function setupPreconditions(Factory&MockObject $factory): void
    {
        $factory
            ->method('create')
            ->willReturnCallback(fn (string $class, ?object $data) => is_null($data) ? null : match ($class) {
                SchemaObjectMap::class => new SchemaObjectMap(items: (object)[]),
                ResponseObjectMap::class => new ResponseObjectMap(items: (object)[]),
                ParameterObjectMap::class => new ParameterObjectMap(items: (object)[]),
                ExampleObjectMap::class => new ExampleObjectMap(items: (object)[]),
                RequestBodyObjectMap::class => new RequestBodyObjectMap(items: (object)[]),
                HeaderObjectMap::class => new HeaderObjectMap(items: (object)[]),
                SecuritySchemeObjectMap::class => new SecuritySchemeObjectMap(items: (object)[]),
                LinkObjectMap::class => new LinkObjectMap(items: (object)[]),
                CallbackObjectMap::class => new CallbackObjectMap(items: (object)[]),
                PathItemObjectMap::class => new PathItemObjectMap(items: (object)[]),
            });
    }

    public static function examples(): iterable
    {
        yield 'minimal example' => [
            'version' => Version::V3_1,
            'data' => (object) [],
            'expected' => new ComponentsObject(),
        ];

        yield 'full example' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'schemas' => (object) [],
                'responses' => (object) [],
                'parameters' => (object) [],
                'examples' => (object) [],
                'requestBodies' => (object) [],
                'headers' => (object) [],
                'securitySchemes' => (object) [],
                'links' => (object) [],
                'callbacks' => (object) [],
                'pathItems' => (object) [],
            ],
            'expected' => new ComponentsObject(
                schemas: new SchemaObjectMap(items: (object)[]),
                responses: new ResponseObjectMap(items: (object)[]),
                parameters: new ParameterObjectMap(items: (object)[]),
                examples: new ExampleObjectMap(items: (object)[]),
                requestBodies: new RequestBodyObjectMap(items: (object)[]),
                headers: new HeaderObjectMap(items: (object)[]),
                securitySchemes: new SecuritySchemeObjectMap(items: (object)[]),
                links: new LinkObjectMap(items: (object)[]),
                callbacks: new CallbackObjectMap(items: (object)[]),
                pathItems: new PathItemObjectMap(items: (object)[]),
            ),
        ];
    }
}