<?php

namespace Tribe\Validator;

class ActionCreateValidator extends BaseValidator implements Validator
{
    private static array $requiredFields = ['name', 'alias', 'roles'];
    private static array $lengthFields = ['name', 'alias'];

    public function searchForValidationErrors(array $params, int $urlParam = null): array
    {
        return array_merge(
            $this->validateRequiredFields(self::$requiredFields, $params),
            $this->validateLengthFields(self::$lengthFields, $params),
            $this->validateRoles(array_key_exists('roles', $params) ? $params['roles'] : []));
    }
}