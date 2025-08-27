<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use AdamQ\OpenApiParser\Model\SchemaObject;
use AdamQ\OpenApiParser\Model\Version;
use AdamQ\OpenApiParser\Parsing\Factories\SchemaObjectFactory;
use AdamQ\OpenApiParser\Tests\Support\ObjectFactoryTest;
use AdamQ\OpenApiParser\Tests\Support\SpecificationExtensionsObjectFactoryTest;

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
