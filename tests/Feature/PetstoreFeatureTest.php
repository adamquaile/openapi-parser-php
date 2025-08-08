<?php

declare(strict_types=1);

namespace AdamQ\OpenApiParser\Tests\Feature;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use AdamQ\OpenApiParser\Model\ContactObject;
use AdamQ\OpenApiParser\Model\ExternalDocumentationObject;
use AdamQ\OpenApiParser\Model\InfoObject;
use AdamQ\OpenApiParser\Model\LicenseObject;
use AdamQ\OpenApiParser\Model\OpenApiObject;
use AdamQ\OpenApiParser\Model\PathsObject;
use AdamQ\OpenApiParser\Model\ServerObject;
use AdamQ\OpenApiParser\Model\ServersList;
use AdamQ\OpenApiParser\Model\TagObject;
use AdamQ\OpenApiParser\Model\TagsList;
use AdamQ\OpenApiParser\OpenApiParser;

#[CoversClass(OpenApiParser::class)]
final class PetstoreFeatureTest extends TestCase
{
    public function testPetstoreExample(): void
    {
        $openapiParser = new OpenApiParser();
        $openapi = $openapiParser->parseYamlString(
            file_get_contents(__DIR__ . '/../Support/examples/petstore.openapi.yaml')
        );

        $this->assertInstanceOf(OpenApiObject::class, $openapi);
        $this->assertEquals('3.0.4', $openapi->openapi);
        
        $this->assertEquals('Swagger Petstore - OpenAPI 3.0', $openapi->info->title);
        $this->assertEquals('1.0.27', $openapi->info->version);
        $this->assertEquals('https://swagger.io/terms/', $openapi->info->termsOfService);
        $this->assertEquals('apiteam@swagger.io', $openapi->info->contact->email);
        $this->assertEquals('Apache 2.0', $openapi->info->license->name);
        $this->assertEquals('https://www.apache.org/licenses/LICENSE-2.0.html', $openapi->info->license->url);
        
        $this->assertEquals('Find out more about Swagger', $openapi->externalDocs->description);
        $this->assertEquals('https://swagger.io', $openapi->externalDocs->url);
        
        $this->assertInstanceOf(ServersList::class, $openapi->servers);
        $this->assertCount(1, $openapi->servers->items);
        $this->assertEquals('/api/v3', $openapi->servers->items[0]->url);
        
        $this->assertEquals(new TagsList(items: [
            new TagObject(
                name: 'pet',
                description: 'Everything about your Pets',
                externalDocs: new ExternalDocumentationObject(description: 'Find out more', url: 'https://swagger.io')),
            new TagObject(
                name: 'store',
                description: 'Access to Petstore orders',
                externalDocs: new ExternalDocumentationObject(description: 'Find out more about our store', url: 'https://swagger.io')),
            new TagObject(
                name: 'user',
                description: 'Operations about user',
            ),
        ]), $openapi->tags);
        
        $this->assertInstanceOf(PathsObject::class, $openapi->paths);
        $this->assertObjectHasProperty('/pet', $openapi->paths->items);
        $this->assertObjectHasProperty('/user', $openapi->paths->items);
    }
}