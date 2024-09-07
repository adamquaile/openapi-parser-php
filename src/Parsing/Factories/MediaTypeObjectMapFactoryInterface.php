<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Parsing\Factories;

use Worq\OpenApiParser\Model\MediaTypeObjectMap;
use Worq\OpenApiParser\Parsing\ParseContext;

interface MediaTypeObjectMapFactoryInterface
{
    public function create(array $data, ParseContext $context): MediaTypeObjectMap;
}
