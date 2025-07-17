<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Parsing\Factories;

use TypeSlow\OpenApiParser\Model\CallbackObject;
use TypeSlow\OpenApiParser\Model\PathItemObject;
use TypeSlow\OpenApiParser\Model\ReferenceObject;
use TypeSlow\OpenApiParser\Parsing\ParseContext;

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
