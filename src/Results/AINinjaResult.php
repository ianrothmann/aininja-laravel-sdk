<?php

namespace IanRothmann\AINinja\Results;

class AINinjaResult
{
    protected $result;

    public function __construct($result)
    {
        $this->result = $result;
    }

    public function getResult()
    {
        return $this->result;
    }
}
