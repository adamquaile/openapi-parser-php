<?php

namespace TypeSlow\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use TypeSlow\OpenApiParser\Model\ContactObject;
use TypeSlow\OpenApiParser\Model\InfoObject;
use TypeSlow\OpenApiParser\Model\LicenseObject;
use TypeSlow\OpenApiParser\Model\Version;
use TypeSlow\OpenApiParser\Parsing\Factories\InfoObjectFactory;
use TypeSlow\OpenApiParser\Parsing\Factory;
use TypeSlow\OpenApiParser\Tests\Support\ObjectFactoryTest;
use TypeSlow\OpenApiParser\Tests\Support\SpecificationExtensionsObjectFactoryTest;

#[CoversClass(InfoObject::class)]
#[CoversClass(InfoObjectFactory::class)]
class InfoObjectFactoryTest extends TestCase
{
    use ObjectFactoryTest;
    use SpecificationExtensionsObjectFactoryTest;

    protected function setupPreconditions(Factory&MockObject $factory): void
    {
        $factory
            ->method('create')
            ->willReturnCallback(fn (string $class, ?object $data) => is_null($data) ? null : match ($class) {
                ContactObject::class => new ContactObject(
                    name: 'API Support',
                    url: 'https://www.example.com/support',
                    email: 'support@example.com',
                ),
                LicenseObject::class => new LicenseObject(
                    name: 'Apache 2.0',
                    url: 'https://www.apache.org/licenses/LICENSE-2.0.html',
                ),
            });
    }

    public static function examples(): iterable
    {
        yield 'minimal example @3.0' => [
            'version' => Version::V3_0,
            'data' => (object) [
                'title' => 'Minimal API',
                'version' => '1.0.0',
            ],
            'expected' => new InfoObject(
                title: 'Minimal API',
                version: '1.0.0'
            ),
        ];

        yield 'spec example @3.1' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'title' => 'Sample Pet Store App',
                'summary' => 'A pet store manager.',
                'description' => 'This is a sample server for a pet store.',
                'termsOfService' => 'https://example.com/terms/',
                'contact' => (object) [],
                'license' => (object) [],
                'version' => '1.0.1',
            ],
            'expected' => new InfoObject(
                title: 'Sample Pet Store App',
                summary: 'A pet store manager.',
                description: 'This is a sample server for a pet store.',
                termsOfService: 'https://example.com/terms/',
                contact: new ContactObject(
                    name: 'API Support',
                    url: 'https://www.example.com/support',
                    email: 'support@example.com',
                ),
                license: new LicenseObject(
                    name: 'Apache 2.0',
                    url: 'https://www.apache.org/licenses/LICENSE-2.0.html',
                ),
                version: '1.0.1',
            )
        ];

        yield 'summary ignored in @3.0' => [
            'version' => Version::V3_0,
            'data' => (object) [
                'title' => 'Sample Pet Store App',
                'summary' => 'A pet store manager.',
                'version' => '1.0.1',
            ],
            'expected' => new InfoObject(
                title: 'Sample Pet Store App',
                version: '1.0.1'
            ),
        ];

        yield 'spec example @3.0' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'title' => 'Sample Pet Store App',
                'description' => 'This is a sample server for a pet store.',
                'termsOfService' => 'https://example.com/terms/',
                'contact' => (object) [],
                'license' => (object) [],
                'version' => '1.0.1',
            ],
            'expected' => new InfoObject(
                title: 'Sample Pet Store App',
                description: 'This is a sample server for a pet store.',
                termsOfService: 'https://example.com/terms/',
                contact: new ContactObject(
                    name: 'API Support',
                    url: 'https://www.example.com/support',
                    email: 'support@example.com',
                ),
                license: new LicenseObject(
                    name: 'Apache 2.0',
                    url: 'https://www.apache.org/licenses/LICENSE-2.0.html',
                ),
                version: '1.0.1',
            )
        ];
    }
}
