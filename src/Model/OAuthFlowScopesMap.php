<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Model;

final class OAuthFlowScopesMap implements MapInterface
{
    use MapTrait;

    public function __construct(
        /** @var \Traversable<string, string> */
        public object $items
    ) {
    }
}
