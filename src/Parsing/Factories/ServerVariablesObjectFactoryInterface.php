<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Parsing\Factories;

use Worq\OpenApiParser\Model\ServerVariablesObject;
use Worq\OpenApiParser\Parsing\ParseContext;

interface ServerVariablesObjectFactoryInterface
{
    public function create(object $data, ParseContext $context): ServerVariablesObject;
}
