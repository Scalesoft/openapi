<?php

/**
 * Test: SchemaType\BaseSchemaType
 */

require_once __DIR__ . '/../../bootstrap.php';

use Apitte\Core\Schema\EndpointParameter;
use Apitte\OpenApi\Schema\Schema;
use Apitte\OpenApi\SchemaType\BaseSchemaType;
use Apitte\OpenApi\SchemaType\ISchemaType;
use Apitte\OpenApi\SchemaType\UnknownSchemaType;
use Tester\Assert;
use Tester\TestCase;

final class TestBaseSchemaType extends TestCase
{

	/**
	 * @var ISchemaType
	 */
	private $baseSchemaType;

	protected function setUp()
	{
		$this->baseSchemaType = new BaseSchemaType;
	}

	public function testScalar()
	{
		$endpointParameter = new EndpointParameter;
		$endpointParameter->setType(EndpointParameter::TYPE_SCALAR);

		$scalarSchema = $this->baseSchemaType->createSchema($endpointParameter);

		Assert::type(Schema::class, $scalarSchema);
		Assert::same(
			[
				'type' => 'scalar',
			],
			$scalarSchema->toArray()
		);
	}

	public function testString()
	{
		$endpointParameter = new EndpointParameter;
		$endpointParameter->setType(EndpointParameter::TYPE_STRING);

		$scalarSchema = $this->baseSchemaType->createSchema($endpointParameter);

		Assert::type(Schema::class, $scalarSchema);
		Assert::same(
			[
				'type' => 'string',
			],
			$scalarSchema->toArray()
		);
	}

	public function testInteger()
	{
		$endpointParameter = new EndpointParameter;
		$endpointParameter->setType(EndpointParameter::TYPE_INTEGER);

		$scalarSchema = $this->baseSchemaType->createSchema($endpointParameter);

		Assert::type(Schema::class, $scalarSchema);
		Assert::same(
			[
				'type'   => 'integer',
				'format' => 'int32',
			],
			$scalarSchema->toArray()
		);
	}

	public function testFloat()
	{
		$endpointParameter = new EndpointParameter;
		$endpointParameter->setType(EndpointParameter::TYPE_FLOAT);

		$scalarSchema = $this->baseSchemaType->createSchema($endpointParameter);

		Assert::type(Schema::class, $scalarSchema);
		Assert::same(
			[
				'type'   => 'float',
				'format' => 'float64',
			],
			$scalarSchema->toArray()
		);
	}

	public function testBoolean()
	{
		$endpointParameter = new EndpointParameter;
		$endpointParameter->setType(EndpointParameter::TYPE_BOOLEAN);

		$scalarSchema = $this->baseSchemaType->createSchema($endpointParameter);

		Assert::type(Schema::class, $scalarSchema);
		Assert::same(
			[
				'type' => 'boolean',
			],
			$scalarSchema->toArray()
		);
	}

	public function testDatetime()
	{
		$endpointParameter = new EndpointParameter;
		$endpointParameter->setType(EndpointParameter::TYPE_DATETIME);

		$scalarSchema = $this->baseSchemaType->createSchema($endpointParameter);

		Assert::type(Schema::class, $scalarSchema);
		Assert::same(
			[
				'type'   => 'string',
				'format' => 'date-time',
			],
			$scalarSchema->toArray()
		);
	}

	public function testObject()
	{
		$endpointParameter = new EndpointParameter;
		$endpointParameter->setType(EndpointParameter::TYPE_OBJECT);

		$scalarSchema = $this->baseSchemaType->createSchema($endpointParameter);

		Assert::type(Schema::class, $scalarSchema);
		Assert::same(
			[
				'type' => 'object',
			],
			$scalarSchema->toArray()
		);
	}

	public function testUnknownType()
	{
		$endpointParameter = new EndpointParameter;
		$endpointParameter->setType('barBaz');

		Assert::throws(function () use ($endpointParameter) {
			$this->baseSchemaType->createSchema($endpointParameter);
		}, UnknownSchemaType::class, 'Unknown endpoint parameter type barBaz');
	}

}

(new TestBaseSchemaType)->run();
