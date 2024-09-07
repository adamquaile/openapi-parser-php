<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Parsing\Factories;

use Worq\OpenApiParser\Model\InfoObject;
use Worq\OpenApiParser\Parsing\ParseContext;

interface InfoObjectFactoryInterface
{
    public function create(array $data, ParseContext $context): InfoObject;
}
