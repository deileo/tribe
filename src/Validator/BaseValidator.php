<?php

namespace Tribe\Validator;

use Tribe\Entity\Traits\RolesTrait;

class BaseValidator
{
    protected function validateRequiredFields(array $requiredFields, array $params): array
    {
        $errors = [];
        foreach ($requiredFields as $field) {
            if (!array_key_exists($field, $params) || !$params[$field]) {
                $errors[] = sprintf('%s field is required!', $field);
            }
        }

        return $errors;
    }

    protected function validateLengthFields(array $lengthFields, array $params): array
    {
        $errors = [];
        foreach ($lengthFields as $field) {
            if (strlen($params[$field]) > 255) {
                $errors[] = sprintf('%s field value is too long!', $field);
            }
        }

        return $errors;
    }

    protected function validateRoles(array $roles): array
    {
        $errors = [];
        foreach ($roles as $role) {
            if (!array_key_exists($role, RolesTrait::$roleMap)) {
                $errors[] = sprintf('%s role does not exist!', $role);
            }
        }

        return $errors;
    }
}