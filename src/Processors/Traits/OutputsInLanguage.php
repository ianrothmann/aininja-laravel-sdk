<?php

namespace IanRothmann\AINinja\Processors\Traits;

trait OutputsInLanguage
{
    public function outputInLanguage($code, $language): self
    {
        $this->setInputParameter('language', $language);
        $this->setInputParameter('language_code', $code);

        return $this;
    }
}
