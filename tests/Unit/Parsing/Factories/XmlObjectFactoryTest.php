<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use TypeSlow\OpenApiParser\Model\Version;
use TypeSlow\OpenApiParser\Model\XmlObject;
use TypeSlow\OpenApiParser\Parsing\Factories\XmlObjectFactory;
use TypeSlow\OpenApiParser\Tests\Support\ObjectFactoryTest;
use TypeSlow\OpenApiParser\Tests\Support\SpecificationExtensionsObjectFactoryTest;

#[CoversClass(XmlObject::class)]
#[CoversClass(XmlObjectFactory::class)]
final class XmlObjectFactoryTest extends TestCase
{
    use ObjectFactoryTest;
    use SpecificationExtensionsObjectFactoryTest;

    public static function examples(): iterable
    {
        yield 'full example @3.1' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'name' => 'person',
                'namespace' => 'http://example.com/schema',
                'prefix' => 'person',
                'attribute' => true,
                'wrapped' => true,
            ],
            'expected' => new XmlObject(
                name: 'person',
                namespace: 'http://example.com/schema',
                prefix: 'person',
                attribute: true,
                wrapped: true,
            ),
        ];
        yield 'name only example @3.1' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'name' => 'person',
            ],
            'expected' => new XmlObject(
                name: 'person',
                attribute: false,
                wrapped: false,
            ),
        ];
    }

}
