<?php

namespace Core;

use Core\Facades\DB;
use Core\Exceptions\ValidationException;

class Validator
{
    protected $data;
    protected $rules;
    protected $errors = [];

    public function __construct($data, $rules)
    {
        $this->data = $data;
        $this->rules = $rules;

        foreach ($this->rules as $field => $fieldRules) {
            foreach ($fieldRules as $rule) {
                $ruleParts = explode(':', $rule);
                $ruleName = $ruleParts[0];

                if (method_exists($this, $ruleName)) {
                    $this->$ruleName($field, $ruleParts);
                }
            }
        }

        return empty($this->errors);
    }

    public static function make($data, $rules)
    {
        return new static($data, $rules);
    }

    public function validate()
    {
        if ($this->fails()) {
            throw ValidationException::withMessage($this->getErrors());
        }
    }

    protected function required($field, $ruleParts)
    {
        if (!isset($this->data[$field]) || empty($this->data[$field])) {
            $this->addError($field, "The $field field is required.");
        }
    }

    protected function max($field, $ruleParts)
    {
        $maxLength = (int) $ruleParts[1];
        $fieldValue = $this->data[$field] ?? '';

        if (strlen($fieldValue) > $maxLength) {
            $this->addError($field, "The $field field must not exceed $maxLength characters.");
        }
    }

    protected function unique($field, $ruleParts)
    {
        $ruleParts = explode(',', $ruleParts[1]);
        $table = $ruleParts[0];
        $column = $ruleParts[1] ?? $field;
        $exceptValue = $ruleParts[2] ?? null;
        $exceptColumn = $ruleParts[3] ?? null;

        $value = $this->data[$field] ?? null;
        if ($exceptValue) {
            $result = DB::query("select * from $table where $column=:value and $exceptColumn<>:exceptValue", [
                'value' => $value,
                'exceptValue' => $exceptValue,
            ])->first();
        } else {
            $result = DB::query("select * from $table where $column=:value", [
                'value' => $value,
            ])->first();
        }

        if ($result) {
            $this->addError($field, "The $field field must be unique.");
        }
    }

    protected function addError($field, $message)
    {
        $this->errors[$field][] = $message;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function fails()
    {
        return count($this->errors) > 0;
    }
}
