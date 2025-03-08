<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use TypeSlow\OpenApiParser\Model\DiscriminatorObject;
use TypeSlow\OpenApiParser\Model\Version;
use TypeSlow\OpenApiParser\Parsing\Factories\DiscriminatorObjectFactory;
use TypeSlow\OpenApiParser\Tests\Support\ObjectFactoryTest;
use TypeSlow\OpenApiParser\Tests\Support\SpecificationExtensionsObjectFactoryTest;

#[CoversClass(DiscriminatorObject::class)]
#[CoversClass(DiscriminatorObjectFactory::class)]
final class DiscriminatorObjectFactoryTest extends TestCase
{
    use ObjectFactoryTest;
    use SpecificationExtensionsObjectFactoryTest;

    public static function examples()
    {
        yield 'minimal @3.1' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'propertyName' => 'type',
            ],
            'expected' => new DiscriminatorObject(
                propertyName: 'type',
            )
        ];
        yield 'example with mapping @3.1' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'propertyName' => 'type',
                'mapping' => (object) [
                    'dog' => '#/components/schemas/Dog',
                    'cat' => '#/components/schemas/Cat',
                ],
            ],
            'expected' => new DiscriminatorObject(
                propertyName: 'type',
                mapping: (object) [
                    'dog' => '#/components/schemas/Dog',
                    'cat' => '#/components/schemas/Cat',
                ],
            )
        ];
    }
}
