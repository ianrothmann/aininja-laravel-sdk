<?php

namespace IanRothmann\AINinja\Processors\Traits;

trait ProcessorTraitDetection
{
    protected function hasTrait($traitName): bool
    {
        $traits = class_uses($this);

        return in_array($traitName, $traits);
    }
}
