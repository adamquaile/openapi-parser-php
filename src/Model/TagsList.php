<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Model;

final class TagsList
{
    /**
     * @param array<TagObject> $items
     */
    public function __construct(public array $items)
    {
    }
}