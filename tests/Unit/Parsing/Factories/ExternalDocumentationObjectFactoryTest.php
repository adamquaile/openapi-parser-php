<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use TypeSlow\OpenApiParser\Model\ExternalDocumentationObject;
use TypeSlow\OpenApiParser\Model\Version;
use TypeSlow\OpenApiParser\Parsing\Factories\ExternalDocumentationObjectFactory;
use TypeSlow\OpenApiParser\Tests\Support\ObjectFactoryTest;
use TypeSlow\OpenApiParser\Tests\Support\SpecificationExtensionsObjectFactoryTest;

#[CoversClass(ExternalDocumentationObject::class)]
#[CoversClass(ExternalDocumentationObjectFactory::class)]
final class ExternalDocumentationObjectFactoryTest extends TestCase
{
    use ObjectFactoryTest;
    use SpecificationExtensionsObjectFactoryTest;

    public static function examples(): iterable
    {
        yield 'example from spec' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'url' => 'https://example.com/',
                'description' => 'Find more info here',
            ],
            'expected' => new ExternalDocumentationObject(
                url: 'https://example.com/',
                description: 'Find more info here',
            )
        ];
    }
}
