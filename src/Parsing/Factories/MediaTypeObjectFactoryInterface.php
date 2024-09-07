<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Parsing\Factories;

use Worq\OpenApiParser\Model\MediaTypeObject;
use Worq\OpenApiParser\Parsing\ParseContext;

interface MediaTypeObjectFactoryInterface
{
    public function create(array $data, ParseContext $context): MediaTypeObject;
}
