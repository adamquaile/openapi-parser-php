<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Parsing\Factories;

use Worq\OpenApiParser\Model\ContactObject;
use Worq\OpenApiParser\Parsing\ParseContext;

interface ContactObjectFactoryInterface
{
    public function create(object $data, ParseContext $context): ContactObject;
}
