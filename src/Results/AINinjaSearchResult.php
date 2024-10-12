<?php

namespace IanRothmann\AINinja\Results;

use IanRothmann\AINinja\Results\Containers\QueryAnswerSourceDocument;
use Illuminate\Support\Collection;

class AINinjaSearchResult extends AINinjaResult
{
    /**
     * @return Collection<int, QueryAnswerSourceDocument>
     */
    public function getSearchResults(): Collection
    {
        return collect(collect($this->result)->get('results'))
            ->map(function($item){
                return QueryAnswerSourceDocument::fromQueryAnswer($item);
            });
    }

}
