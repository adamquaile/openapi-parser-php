<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Model;

final class OAuthFlowScopesMap implements MapInterface
{
    use MapTrait;

    public function __construct(
        /** @var \Traversable<string, string> */
        public object $items
    ) {
    }
}
