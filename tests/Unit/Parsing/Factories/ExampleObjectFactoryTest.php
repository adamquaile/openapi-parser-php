<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use TypeSlow\OpenApiParser\Model\ExampleObject;
use TypeSlow\OpenApiParser\Model\Version;
use TypeSlow\OpenApiParser\Parsing\Factories\ExampleObjectFactory;
use TypeSlow\OpenApiParser\Tests\Support\ObjectFactoryTest;
use TypeSlow\OpenApiParser\Tests\Support\SpecificationExtensionsObjectFactoryTest;

#[CoversClass(ExampleObject::class)]
#[CoversClass(ExampleObjectFactory::class)]
final class ExampleObjectFactoryTest extends TestCase
{
    use ObjectFactoryTest;
    use SpecificationExtensionsObjectFactoryTest;

    public static function examples(): iterable
    {
        yield 'a foo example from spec @3.1' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'summary' => 'A foo example',
                'value' => (object) [
                    'foo' => 'bar',
                ],
            ],
            'expected' => new ExampleObject(
                summary: 'A foo example',
                value: (object) [
                    'foo' => 'bar',
                ],
            )
        ];

        yield 'a minimal example @3.1' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'value' => 'foo',
            ],
            'expected' => new ExampleObject(
                value: 'foo',
            )
        ];

        yield 'an example with description @3.0' => [
            'version' => Version::V3_0,
            'data' => (object) [
                'description' => 'An example UUID',
                'value' => '38400000-8cf0-11bd-b23e-10b96e4ef00d',
            ],
            'expected' => new ExampleObject(
                description: 'An example UUID',
                value: '38400000-8cf0-11bd-b23e-10b96e4ef00d',
            )
        ];
    }
}
