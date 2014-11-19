<?php
namespace Shin1x1\ValidatorBuilder;

/**
 * Interface ValidatorBuilder
 * @package Shin1x1\ValidatorBuilder
 */
interface ValidatorBuilder
{
    /**
     * @param array $inputs
     * @return \Illuminate\Validation\Validator
     */
    public function create(array $inputs);
}