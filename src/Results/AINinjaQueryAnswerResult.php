<?php

namespace IanRothmann\AINinja\Results;

use IanRothmann\AINinja\Results\Containers\QueryAnswerSourceDocument;
use Illuminate\Support\Collection;

class AINinjaQueryAnswerResult extends AINinjaResult
{

    public function getQuestion(): ?string
    {
        return collect($this->result)->get('input');
    }

    public function getAnswer(): ?string
    {
        return collect($this->result)->get('answer');
    }

    /**
     * @return Collection<int, QueryAnswerSourceDocument>
     */
    public function getContext(): Collection
    {
        return collect(collect($this->result)->get('context'))
            ->map(function($item){
                return QueryAnswerSourceDocument::fromQueryAnswer($item);
            });
    }

}
