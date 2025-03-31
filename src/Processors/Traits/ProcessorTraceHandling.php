<?php

namespace IanRothmann\AINinja\Processors\Traits;

use Illuminate\Database\Eloquent\Model;

trait ProcessorTraceHandling
{
    protected ?string $traceId = null;

    public function setTraceId($traceId): self
    {
        $this->traceId = (string) $traceId;

        return $this;
    }

    public function traceModel(Model $model): self
    {
        $modelName = class_basename($model);
        $primaryKeyValue = $model->getKey();
        $this->traceId = $modelName.':'.$primaryKeyValue;

        return $this;
    }
}
