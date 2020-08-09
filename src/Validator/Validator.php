<?php

namespace Tribe\Validator;

interface Validator
{
    public function searchForValidationErrors(array $params, int $urlParam = null): array;
}