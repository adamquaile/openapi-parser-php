<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Tests\Parsing;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Worq\OpenApiParser\Parsing\DocumentPath;

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