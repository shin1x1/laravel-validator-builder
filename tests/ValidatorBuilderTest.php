<?php
namespace Shin1x1\ValidatorBuilder\Test;

use Illuminate\Support\MessageBag;
use Mockery;
use PHPUnit_Framework_TestCase;
use Shin1x1\ValidatorBuilder\ValidatorBuilderTestTrait;

/**
 * Class ValidatorBuilderTest
 * @package Shin1x1\ValidatorBuilder\Test
 */
class ValidatorBuilderTest extends PHPUnit_Framework_TestCase
{
    use ValidatorBuilderTestTrait;

    /**
     * setUp
     */
    public function setUp()
    {
        parent::setUp();

        $validator = Mockery::mock();
        $validator->shouldReceive('passes')->andReturn(true);

        $this->builder = Mockery::mock();
        $this->builder->shouldReceive('create')->andReturn($validator);

        $this->okInputs = [
            'name' => 'name1',
        ];

        $this->testInputs = [
            'name' => [
               'ok' => true,
            ],
        ];
    }

    /**
     *
     */
    public function testInputsNg()
    {
        $validator = Mockery::mock();
        $validator->shouldReceive('passes')->andReturn(false);
        $validator->shouldReceive('errors')->andReturn(new MessageBag(['name' => 'error']));

        $this->builder = Mockery::mock();
        $this->builder->shouldReceive('create')->andReturn($validator);

        $this->okInputs = [
            'name' => 'name1',
        ];

        $this->testInputs = [
            'name' => [
                'ng' => false,
            ],
        ];

        $this->passes_testInputs();
    }
}
