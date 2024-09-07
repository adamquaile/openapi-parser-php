<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Tests\Model;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Worq\OpenApiParser\Model\Version;

#[CoversClass(Version::class)]
final class VersionTest extends TestCase
{
    #[DataProvider(methodName: 'validVersionsDataProvider')]
    public function testValidVersions(string $version, Version $expected): void
    {
        self::assertEquals($expected, Version::fromString($version));
    }

    public static function validVersionsDataProvider(): iterable
    {
        yield '3.0' => ['3.0', Version::V3_0];
        yield '3.0.0' => ['3.0.0', Version::V3_0];
        yield '3.0.1' => ['3.0.1', Version::V3_0];
        yield '3.0.99' => ['3.0.99', Version::V3_0];
        yield '3.1' => ['3.1', Version::V3_1];
        yield '3.1.1' => ['3.1.1', Version::V3_1];
        yield '3.1.99' => ['3.1.99', Version::V3_1];
    }

}
