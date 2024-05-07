<?php

namespace IanRothmann\AINinja\Results;

class AINinjaTranslateResult extends AINinjaResult
{
    public function getTranslation(): ?array
    {
        return $this->result['translations'] ?? null;
    }
}
