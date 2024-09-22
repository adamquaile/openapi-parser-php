<?php

declare(strict_types=1);

namespace TypeSlow\OpenApiParser\Tests\Feature;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use TypeSlow\OpenApiParser\Model\ContactObject;
use TypeSlow\OpenApiParser\Model\InfoObject;
use TypeSlow\OpenApiParser\Model\OpenApiObject;
use TypeSlow\OpenApiParser\Model\PathsObject;
use TypeSlow\OpenApiParser\OpenApiParser;

#[CoversClass(OpenApiParser::class)]
final class SpecificationExtensionsFeatureTest extends TestCase
{
    public function testSpecificationExample(): void
    {
        $openapiParser = new OpenApiParser();
        $openapi = $openapiParser->parseYamlString(
            file_get_contents(__DIR__ . '/../Support/examples/specification-extensions.openapi.yaml')
        );

        $this->assertEquals(
            new OpenApiObject(
                openapi: '3.1.0',
                info: new InfoObject(
                    title: 'Specification Extensions Example',
                    version: '1.0.0',
                    contact: new ContactObject(
                        x: (object) [
                            'socials' => (object) [
                                'github' => 'github-username',
                                'linkedin' => 'linkedin-username',
                            ]
                        ]
                    ),
                    x: (object) ['internal-id' => '1234'],
                ),
                paths: new PathsObject(items: (object) []),
            ),
            $openapi
        );

        $this->assertSame('1234', $openapi->info->x->{'internal-id'});
        $this->assertSame('github-username', $openapi->info->contact->x->socials->{'github'});
    }
}
