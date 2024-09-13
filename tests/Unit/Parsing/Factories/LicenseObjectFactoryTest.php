<?php

namespace Worq\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Worq\OpenApiParser\Model\LicenseObject;
use Worq\OpenApiParser\Model\Version;
use Worq\OpenApiParser\Tests\Support\ObjectFactoryTest;

#[CoversClass(LicenseObject::class)]
#[CoversClass(LicenseObjectFactoryTest::class)]
class LicenseObjectFactoryTest extends TestCase
{
    use ObjectFactoryTest;

    public static function examples(): iterable
    {
        yield 'minimal @3.1' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'name' => 'Apache 2.0',
            ],
            'expected' => new LicenseObject(name: 'Apache 2.0')
        ];

        yield 'complete @3.0' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'name' => 'Apache 2.0',
                'url' => 'https://www.apache.org/licenses/LICENSE-2.0.html',
            ],
            'expected' => new LicenseObject(
                name: 'Apache 2.0',
                url: 'https://www.apache.org/licenses/LICENSE-2.0.html'
            )
        ];

        yield 'extra unused identifier not specified in @3.0' => [
            'version' => Version::V3_0,
            'data' => (object) [
                'name' => 'Apache 2.0',
                'identifier' => 'Apache-2.0',
                'url' => 'https://www.apache.org/licenses/LICENSE-2.0.html',
            ],
            'expected' => new LicenseObject(
                name: 'Apache 2.0',
                url: 'https://www.apache.org/licenses/LICENSE-2.0.html'
            )
        ];

        yield 'complete with url @3.1' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'name' => 'Apache 2.0',
                'url' => 'https://www.apache.org/licenses/LICENSE-2.0.html',
            ],
            'expected' => new LicenseObject(
                name: 'Apache 2.0',
                url: 'https://www.apache.org/licenses/LICENSE-2.0.html'
            )
        ];

        yield 'complete with identifier @3.1' => [
            'version' => Version::V3_1,
            'data' => (object) [
                'name' => 'Apache 2.0',
                'identifier' => 'Apache-2.0',
            ],
            'expected' => new LicenseObject(
                name: 'Apache 2.0',
                identifier: 'Apache-2.0',
            )
        ];
    }
}
