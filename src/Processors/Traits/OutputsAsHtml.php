<?php

namespace IanRothmann\AINinja\Processors\Traits;

trait OutputsAsHtml
{
    public function outputTextHtml($outputHtml = true): self
    {
        $this->setInputParameter('output_html', $outputHtml);

        return $this;
    }
}
