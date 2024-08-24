<?php

namespace IanRothmann\AINinja\Results;

use Illuminate\Support\Collection;

class AINinjaCodeNamePairResult extends AINinjaResult
{
    public function getCode(): ?string
    {
        return collect($this->result)->get('code');
    }

    public function getName(): ?string
    {
        return collect($this->result)->get('name');
    }

    public function hasResult(): bool
    {
        return $this->getName() && $this->getName() !== 'Unknown';
    }
}
