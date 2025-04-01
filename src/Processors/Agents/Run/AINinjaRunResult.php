<?php

namespace IanRothmann\AINinja\Processors\Agents\Run;

use Illuminate\Support\Collection;

class AINinjaRunResult
{
    protected $status;

    protected $result;

    public function __construct($result)
    {
        $this->status = $result['status'];
        $this->result = $result['response'] ?? [];
    }

    public function isSuccessful()
    {
        return $this->status == 'success';
    }

    public function isPending()
    {
        return $this->status == 'pending' || $this->status == 'running';
    }

    public function hasError()
    {
        return $this->status == 'error';
    }

    public function getResult(): Collection
    {
        return collect($this->result);
    }
}
