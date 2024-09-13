<?php

namespace Worq\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Worq\OpenApiParser\Model\ContactObject;
use Worq\OpenApiParser\Model\Version;
use Worq\OpenApiParser\Parsing\Factories\ContactObjectFactory;
use Worq\OpenApiParser\Tests\Support\ObjectFactoryTest;
use Worq\OpenApiParser\Tests\Support\SpecificationExtensionsObjectFactoryTest;

#[CoversClass(ContactObjectFactory::class)]
#[CoversClass(ContactObject::class)]
class ContactObjectFactoryTest extends TestCase
{
    use ObjectFactoryTest;
    use SpecificationExtensionsObjectFactoryTest;

    public static function examples(): iterable
    {
        yield 'empty object @3.1' => [
            'version' => Version::V3_1,
            'data' => (object) [],
            'expected' => new ContactObject(),
        ];

        yield 'empty object @3.0' => [
            'version' => Version::V3_1,
            'data' => (object) [],
            'expected' => new ContactObject(),
        ];

        yield 'spec example @3.1' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'name' => 'API Support',
                'url' => 'http://www.example.com/support',
                'email' => 'support@example.com',
            ],
            'expected' => new ContactObject(
                name: 'API Support',
                url: 'http://www.example.com/support',
                email: 'support@example.com'
            ),
        ];
    }
}
