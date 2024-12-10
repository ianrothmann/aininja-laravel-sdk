<?php

namespace IanRothmann\AINinja\Results;

class AINinjaRoleProfileResult extends AINinjaResult
{
    public function getTitle(): ?string
    {
        return $this->result['title'] ?? null;
    }

    public function getRoleProfile(): ?string
    {
        return $this->result['role_profile'] ?? null;
    }
}
