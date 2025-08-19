<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Model;

final class ParametersList
{
    public function __construct(
        /** @var array<ParameterObject|ReferenceObject> */
        public array $items
    ) {
    }
}
