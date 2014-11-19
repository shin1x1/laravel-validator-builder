<?php
namespace Shin1x1\ValidatorBuilder;

/**
 * Class ValidatorBuilderTestTrait
 * @package Shin1x1\ValidatorBuilder
 * @method assertTrue
 * @method assertFalse
 * @method assertEquals
 */
trait ValidatorBuilderTestTrait
{
    /**
     * @var ValidatorBuilder
     */
    protected $builder;

    /**
     * @var array
     */
    protected $okInputs = [];

    /**
     * @var array
     */
    protected $testInputs = [];

    /**
     * @test
     */
    public function passesOkInputs()
    {
        $this->assertTrue($this->passes());
    }

    /**
     * @test
     */
    public function passes_testInputs()
    {
        if (!isset($this->testInputs)) {
            return;
        }

        foreach ($this->testInputs as $column => $values) {
            foreach ($values as $value => $passes) {
                $data = $this->okInputs;
                $data[$column] = $value;

                $validator = $this->builder->create($data);

                if ($passes) {
                    $this->assertTrue($validator->passes(), $column . ' => ' . $value);
                } else {
                    $this->assertFalse($validator->passes(), $column . ' => ' . $value);
                    $expected = [
                        $column,
                    ];
                    $this->assertEquals($expected, array_keys($validator->errors()->toArray()));
                }
            }
        }

    }

    /**
     * @return bool
     */
    protected function passes()
    {
        return $this->builder->create($this->okInputs)->passes();
    }

    /**
     * @return bool
     */
    protected function fails()
    {
        return $this->builder->create($this->okInputs)->fails();
    }
}
