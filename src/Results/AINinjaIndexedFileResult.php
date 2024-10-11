<?php

namespace IanRothmann\AINinja\Results;

use Illuminate\Support\Collection;

class AINinjaIndexedFileResult extends AINinjaResult
{

    public function getCollectionReference(): ?string
    {
        return collect($this->result)->get('collection_name');
    }

    public function getTitle(): ?string
    {
        return collect($this->result)->get('title');
    }

    public function getSummary(): ?string
    {
        return collect($this->result)->get('summary');
    }

}
