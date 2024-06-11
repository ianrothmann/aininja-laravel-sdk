<?php

namespace IanRothmann\AINinja\Results;

use Illuminate\Support\Collection;

class AINinjaJsonResult
{
    protected $result;

    public function __construct($result)
    {
        $this->result = $result;
    }

    public function getResult(): Collection
    {
        return collect($this->result);
    }
}
