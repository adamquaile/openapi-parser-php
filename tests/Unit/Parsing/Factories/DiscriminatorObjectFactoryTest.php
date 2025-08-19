<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use AdamQ\OpenApiParser\Model\DiscriminatorObject;
use AdamQ\OpenApiParser\Model\Version;
use AdamQ\OpenApiParser\Parsing\Factories\DiscriminatorObjectFactory;
use AdamQ\OpenApiParser\Tests\Support\ObjectFactoryTest;
use AdamQ\OpenApiParser\Tests\Support\SpecificationExtensionsObjectFactoryTest;

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
