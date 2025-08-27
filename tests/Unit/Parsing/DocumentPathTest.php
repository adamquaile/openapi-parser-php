<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Tests\Unit\Parsing;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use AdamQ\OpenApiParser\Parsing\DocumentPath;

#[CoversClass(DocumentPath::class)]
final class DocumentPathTest extends TestCase
{
    public function testRootIsDollar(): void
    {
        $this->assertSame(
            '$',
            (string) new DocumentPath()
        );
    }

    public function testItCanAppendPath(): void
    {
        $this->assertSame(
            '$.components',
            (string) (new DocumentPath())->append('components')
        );
    }
}