<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Model;

/**
 * @implements MapInterface<ResponseObject>
 */
#[\AllowDynamicProperties]
final class ResponsesObject implements MapInterface, HasSpecificationExtensions
{
    use MapTrait;

    public function __construct(
        /** @var \Traversable<string, ResponseObject> */
        public object $items,
        public object $x = new \stdClass(),
    ) {
    }
}
