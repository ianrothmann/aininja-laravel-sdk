<?php

namespace IanRothmann\AINinja\Results;

class AINinjaFaceImageResult extends AINinjaResult
{
    public function getError(): ?string
    {
        return $this->result['error'] ?? null;
    }

    public function getDescription(): ?string
    {
        return $this->result['description'] ?? null;
    }

    public function getComplement(): ?string
    {
        return $this->result['complement'] ?? null;
    }
}
