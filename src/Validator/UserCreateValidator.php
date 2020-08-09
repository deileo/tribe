<?php

namespace Tribe\Validator;

class UserCreateValidator extends BaseValidator implements Validator
{
    private static array $requiredFields = ['email', 'firstName', 'lastName', 'roles'];
    private static array $lengthFields = ['email', 'firstName', 'lastName'];

    public function searchForValidationErrors(array $params, int $urlParam = null): array
    {
        return array_merge(
            $this->validateRequiredFields(self::$requiredFields, $params),
            $this->validateLengthFields(self::$lengthFields, $params),
            $this->validateRoles(array_key_exists('roles', $params) ? $params['roles'] : []));
    }
}