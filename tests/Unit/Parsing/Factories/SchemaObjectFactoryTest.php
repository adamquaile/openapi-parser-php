<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use TypeSlow\OpenApiParser\Model\SchemaObject;
use TypeSlow\OpenApiParser\Model\Version;
use TypeSlow\OpenApiParser\Parsing\Factories\SchemaObjectFactory;
use TypeSlow\OpenApiParser\Tests\Support\ObjectFactoryTest;
use TypeSlow\OpenApiParser\Tests\Support\SpecificationExtensionsObjectFactoryTest;

#[CoversClass(SchemaObject::class)]
#[CoversClass(SchemaObjectFactory::class)]
final class SchemaObjectFactoryTest extends TestCase
{
    use ObjectFactoryTest;
    use SpecificationExtensionsObjectFactoryTest;

    public static function examples(): iterable
    {
        yield 'primitive spec example @3.1' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'type' => 'string',
                'format' => 'email',
            ],
            'expected' => new SchemaObject(
                dynamic: (object) [
                    'type' => 'string',
                    'format' => 'email',
                ]
            ),
        ];
    }
}
