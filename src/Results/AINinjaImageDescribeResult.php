<?php

namespace IanRothmann\AINinja\Results;

class AINinjaImageDescribeResult extends AINinjaResult
{
    public function getDescription(): ?string
    {
        return $this->result['description'] ?? null;
    }

    public function getComplement(): ?string
    {
        return $this->result['complement'] ?? null;
    }
}
