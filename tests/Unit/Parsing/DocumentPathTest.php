<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Tests\Parsing;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use TypeSlow\OpenApiParser\Parsing\DocumentPath;

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
}