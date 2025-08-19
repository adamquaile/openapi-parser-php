<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Tests\Unit\Parsing\Factories;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use AdamQ\OpenApiParser\Model\RuntimeExpression;
use AdamQ\OpenApiParser\Model\Version;
use AdamQ\OpenApiParser\Parsing\Factories\RuntimeExpressionFactory;
use AdamQ\OpenApiParser\Tests\Support\ObjectFactoryTest;

#[CoversClass(RuntimeExpression::class)]
#[CoversClass(RuntimeExpressionFactory::class)]
final class RuntimeExpressionFactoryTest extends TestCase
{
    use ObjectFactoryTest;

    public function testExpressionsAreStringable(): void
    {
        $this->assertSame(
            '$request.header.accept',
            (string) new RuntimeExpression('$request.header.accept')
        );
    }

    public static function examples(): iterable
    {
        yield 'example from spec' => [
            'version' => Version::V3_1,
            'data' => '$request.header.accept',
            'expected' => new RuntimeExpression('$request.header.accept'),
        ];
    }
}
