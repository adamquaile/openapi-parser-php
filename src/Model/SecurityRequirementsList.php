<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Model;

final class SecurityRequirementsList
{
    /**
     * @param array<SecurityRequirementObject> $items
     */
    public function __construct(public array $items)
    {
    }
}
