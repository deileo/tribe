<?php

namespace Tribe\Validator;

class UserUpdateValidator extends UserCreateValidator
{
    public function searchForValidationErrors(array $params, int $urlParam = null): array
    {
        return array_merge($urlParam ? [] : ['Must provide User ID in URL'],
            parent::searchForValidationErrors($params));
    }
}