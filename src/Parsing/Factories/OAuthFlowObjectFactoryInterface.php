<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\OAuthFlowObject;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

interface OAuthFlowObjectFactoryInterface
{
    public function create(object $data, ParseContext $context): OAuthFlowObject;
}
