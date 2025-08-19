<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\MapTrait;
use AdamQ\OpenApiParser\Model\ReferenceObject;
use AdamQ\OpenApiParser\Model\ResponseObject;
use AdamQ\OpenApiParser\Model\ResponsesObject;
use AdamQ\OpenApiParser\Parsing\ParseContext;

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
