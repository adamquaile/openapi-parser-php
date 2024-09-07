<?php

namespace Worq\OpenApiParser\Tests\Unit\Model;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Worq\OpenApiParser\Model\InfoObject;

#[CoversClass(InfoObject::class)]
class InfoObjectTest extends TestCase
{

    public function testMinimalExample(): void
    {
        $info = new InfoObject(
            title: 'Minimal API',
            version: '1.0.0'
        );
        self::assertSame('Minimal API', $info->title);
        self::assertNull($info->summary);
        self::assertNull($info->description);
        self::assertNull($info->termsOfService);
        self::assertNull($info->contact);
        self::assertNull($info->license);
        self::assertSame('1.0.0', $info->version);
    }
}
