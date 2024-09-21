<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Parsing\Factories;

use Worq\OpenApiParser\Model\ServerObject;
use Worq\OpenApiParser\Parsing\ParseContext;

interface ServerObjectFactoryInterface
{
    public function create(object $data, ParseContext $context): ServerObject;
}
