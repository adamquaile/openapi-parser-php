<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Parsing;

use Worq\OpenApiParser\Model\Version;

final readonly class ParseContext
{
    public function __construct(
        public Version $version,
        public Factory $factory,
        public DocumentPath $path = new DocumentPath(),
    ) {
    }
}
