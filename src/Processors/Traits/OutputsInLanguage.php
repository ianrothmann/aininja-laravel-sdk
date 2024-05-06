<?php

namespace IanRothmann\AINinja\Processors\Traits;

trait OutputsInLanguage
{
    public function outputInLanguage($code, $language): self
    {
        $this->setInputParameter('output_language_name', $language);
        $this->setInputParameter('output_language_code', $code);
        return $this;
    }
}
