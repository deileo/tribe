<?php

namespace Tribe\Validator;

class ActionUpdateValidator extends BaseValidator implements Validator
{
    private static array $requiredFields = ['alias', 'roles'];

    public function searchForValidationErrors(array $params, int $urlParam = null): array
    {
        return array_merge(
            $this->validateRequiredFields(self::$requiredFields, $params),
            $this->validateRoles($params['roles']));
    }
}