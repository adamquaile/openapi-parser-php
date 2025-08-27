<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\OAuthFlowObject;
use AdamQ\OpenApiParser\Parsing\ParseContext;

interface OAuthFlowObjectFactoryInterface
{
    public function create(object $data, ParseContext $context): OAuthFlowObject;
}
