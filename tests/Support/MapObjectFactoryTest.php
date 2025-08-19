<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Tests\Support;

use PHPUnit\Framework\Attributes\Before;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use AdamQ\OpenApiParser\Model\MapInterface;
use AdamQ\OpenApiParser\Model\Version;
use AdamQ\OpenApiParser\Parsing\Factory;
use AdamQ\OpenApiParser\Parsing\ParseContext;


/**
 * @mixin TestCase
 */
trait MapObjectFactoryTest
{
    private $mapFactory;

    #[Before]
    public function setupMapFactoryUnderTest(): void
    {
        $factoryTestClass = (new \ReflectionClass(static::class))->getShortName();
        self::assertStringEndsWith('Test', $factoryTestClass);
        $factoryClass = self::mapFactoryClass();
        $this->mapFactory = new $factoryClass();
    }

    public function testMapFactoryImplementsInterface(): void
    {
        $interface = $this->mapFactory::class.'Interface';
        $this->assertInstanceOf($interface, $this->mapFactory);
    }

    public function testCanBeCreatedWithTwoStringKeys(): void
    {
        $rawObject1 = (object) ['key' => 'value'];
        $rawObject2 = (object) ['key' => 'value'];

        $object1 = self::firstExample()['expected'];
        $object2 = self::firstExample()['expected'];

        $mapClass = self::mapClass();

        $factory = $this->createMock(Factory::class);
        $context = new ParseContext(Version::V3_0, $factory);
        $factory
            ->method('create')
            ->willReturnCallback(
                fn($class, $data) => match ([$class, $data]) {
                    [$object1::class, $rawObject1] => $object1,
                    [$object2::class, $rawObject2] => $object2,
                    default => $this->fail("Mocked factory::create called with unexpected arguments: $class, " . var_export($data)),
                }
            );

        $mapObject = new $mapClass(items:
            (object)[
                'object_1' => $object1,
                'object_2' => $object2,
            ],
        );

        $this->assertSame($object1, $mapObject->object_1);
        $this->assertSame($object2, $mapObject->object_2);
    }

    /**
     * @template T of MapInterface
     * @return class-string<T>
     */
    abstract public static function mapFactoryClass(): string;

    /**
     * @template T of object
     * @return class-string<T>
     */
    abstract public static function mapClass(): string;
}
