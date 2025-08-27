<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Parsing\Factories;

use AdamQ\OpenApiParser\Model\CallbackObject;
use AdamQ\OpenApiParser\Model\PathItemObject;
use AdamQ\OpenApiParser\Model\ReferenceObject;
use AdamQ\OpenApiParser\Parsing\ParseContext;

final class CallbackObjectFactory implements CallbackObjectFactoryInterface
{
    use MapFactoryTrait;
    use SpecificationExtensionFactoryTrait;

    public function create(object $data, ParseContext $context): CallbackObject
    {
        $callbackData = $this->removeExtendedKeys($data);
        self::modifyEveryObjectProperty(
            $callbackData,
            fn (object $pathItem) => isset($pathItem->{'$ref'})
                ? $context->factory->create(ReferenceObject::class, $pathItem, $context)
                : $context->factory->create(PathItemObject::class, $pathItem, $context)
        );
        return new CallbackObject(
            items: $callbackData,
            x: $this->parsedExtensionObject($data),
        );
    }
}
