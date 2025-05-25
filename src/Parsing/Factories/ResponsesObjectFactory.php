<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\MapTrait;
use TypeSlow\OpenApiParser\Model\ReferenceObject;
use TypeSlow\OpenApiParser\Model\ResponseObject;
use TypeSlow\OpenApiParser\Model\ResponsesObject;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

final class ResponsesObjectFactory implements ResponsesObjectFactoryInterface
{
    use MapFactoryTrait;
    use SpecificationExtensionFactoryTrait;

    public function create(object $data, ParseContext $context): ResponsesObject
    {
        $responseData = $this->removeExtendedKeys($data);
        self::modifyEveryObjectProperty(
            $responseData,
            fn (object $response) => isset($response->{'$ref'})
                ? $context->factory->create(ReferenceObject::class, $response, $context)
                : $context->factory->create(ResponseObject::class, $response, $context),
        );
        return new ResponsesObject(
            items: $responseData,
            x: $this->parsedExtensionObject($data)
        );
    }
}
