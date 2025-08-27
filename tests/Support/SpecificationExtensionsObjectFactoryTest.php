<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Tests\Support;

use PHPUnit\Framework\TestCase;
use AdamQ\OpenApiParser\Model\HasSpecificationExtensions;

/**
 * @mixin TestCase
 * @mixin ObjectFactoryTest
 */
trait SpecificationExtensionsObjectFactoryTest
{

    public function testFirstExamplePassesAlsoSetsSpecificationExamples(): void
    {
        $factoryTestClass = (new \ReflectionClass(static::class))->getShortName();
        self::assertStringEndsWith('FactoryTest', $factoryTestClass);
        $objectClass = '\\AdamQ\\OpenApiParser\\Model\\' . substr($factoryTestClass, 0, -11);

        $this->assertTrue(
            is_a($objectClass, HasSpecificationExtensions::class, allow_string: true),
            "$objectClass must implement " . HasSpecificationExtensions::class
        );

        $firstExample = self::firstExample();

        $firstExample['data']->{'x-foo'} = 'bar';
        $firstExample['data']->{'x-bar'} = (object) ['baz' => 'qux'];
        $firstExample['expected'] = $this->cloneWithExtensions(
            $firstExample['expected'],
            (object) [
                'foo' => 'bar',
                'bar' => (object) ['baz' => 'qux'],
            ]
        );

        $this->testExamples(...$firstExample);
    }

    protected function cloneWithExtensions(object $expectedObject, object $extensions): object
    {
        $params = get_object_vars($expectedObject);
        $params['x'] = $extensions;

        return new $expectedObject(...$params);
    }

}