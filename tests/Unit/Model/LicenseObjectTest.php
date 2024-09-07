<?php

namespace Worq\OpenApiParser\Tests\Unit\Model;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Worq\OpenApiParser\Model\LicenseObject;

#[CoversClass(LicenseObject::class)]
class LicenseObjectTest extends TestCase
{
    public function testMinimalExample(): void
    {
        $license = new LicenseObject(name: 'Apache 2.0');
        self::assertSame('Apache 2.0', $license->name);
        self::assertNull($license->identifier);
        self::assertNull($license->url);
    }

    public function testCompleteExample(): void
    {
        $license = new LicenseObject(
            name: 'Apache 2.0',
            identifier: 'Apache-2.0',
            url: 'https://www.apache.org/licenses/LICENSE-2.0.html'
        );
        self::assertSame('Apache 2.0', $license->name);
        self::assertSame('Apache-2.0', $license->identifier);
        self::assertSame('https://www.apache.org/licenses/LICENSE-2.0.html', $license->url);
    }
}
