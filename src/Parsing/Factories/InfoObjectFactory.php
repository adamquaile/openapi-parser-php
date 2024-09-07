<?php

declare(strict_types=1);

namespace Worq\OpenApiParser\Parsing\Factories;

use Worq\OpenApiParser\Model\InfoObject;
use Worq\OpenApiParser\Model\OpenApiObject;
use Worq\OpenApiParser\Parsing\ParseContext;

final class InfoObjectFactory
{
    public function create(array $data, ParseContext $context): InfoObject
    {
        return new InfoObject(
            title: $data['title'],
            version: $data['version'],
        );
    }
}
