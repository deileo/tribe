<?php

namespace Tribe\Validator;

class PermissionCheckerValidator extends BaseValidator implements Validator
{
    public function searchForValidationErrors(array $params, int $urlParam = null): array
    {
        return $this->validateRequiredFields(['userId', 'alias'], $params);
    }
}