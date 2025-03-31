<?php

namespace IanRothmann\AINinja\Processors\Traits;

trait ProcessorInputHandling
{
    protected $input = [];

    protected function setInputParameter($key, $value): void
    {
        $this->input[$key] = $value;
    }

    protected function addToInputArray($key, $value, $valueKey = null): void
    {
        if (! array_key_exists($key, $this->input)) {
            $this->input[$key] = [];
        }

        if ($valueKey !== null) {
            $this->input[$key][$valueKey] = $value;
        } else {
            $this->input[$key][] = $value;
        }
    }

    protected function addToSubInputArray($mainKey, $key, $value, $valueKey = null): void
    {
        if (! array_key_exists($mainKey, $this->input)) {
            $this->input[$mainKey] = [];
        }

        if (! array_key_exists($key, $this->input[$mainKey])) {
            $this->input[$mainKey][$key] = [];
        }

        if ($valueKey !== null) {
            $this->input[$mainKey][$key][$valueKey] = $value;
        } else {
            $this->input[$mainKey][$key][] = $value;
        }
    }

    protected function transformInputForTransport(): array
    {
        return $this->input;
    }

    protected function getValidationRules(): array
    {
        return [];
    }

    protected function validate(): void
    {
        $rules = $this->getValidationRules();

        $validator = validator($this->input, $rules);

        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }
    }
}
