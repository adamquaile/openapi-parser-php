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
    }
}
