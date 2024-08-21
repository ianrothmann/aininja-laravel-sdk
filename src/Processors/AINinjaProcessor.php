<?php

namespace IanRothmann\AINinja\Processors;

use IanRothmann\AINinja\Processors\Traits\OutputsInLanguage;
use IanRothmann\AINinja\Results\AINinjaResult;
use IanRothmann\AINinja\Runners\AINinjaRunner;
use IanRothmann\LangServePhpClient\Responses\RemoteRunnableResponse;
use IanRothmann\LangServePhpClient\Responses\RemoteRunnableStreamResponse;
use Illuminate\Database\Eloquent\Model;

abstract class AINinjaProcessor
{
    protected $input = [];

    protected $forceNoCache = false;

    protected ?string $traceId = null;

    public function __construct()
    {
        if ($this->hasTrait(OutputsInLanguage::class)) {
            $this->input['output_language_name'] = 'English';
            $this->input['output_language_code'] = 'en';
        }
    }

    abstract protected function getEndpoint(): string;

    abstract protected function getResultClass(): string;

    abstract protected function getMocked();

    public function forceNoCache($force = true): self
    {
        $this->forceNoCache = $force;

        return $this;
    }

    public function get()
    {
        $runner = new AINinjaRunner($this->forceNoCache);

        return $this->hydrateResult($runner->invoke($this));
    }

    public function stream($callback = null)
    {
        $runner = new AINinjaRunner($this->forceNoCache);

        return $this->hydrateResult($runner->stream($this, $callback));
    }

    protected function createResult($content): AINinjaResult
    {
        $class = $this->getResultClass();

        return new $class($content);
    }

    protected function setInputParameter($key, $value): void
    {
        $this->input[$key] = $value;
    }

    protected function addToInputArray($key, $value, $valueKey=null): void
    {
        if (! array_key_exists($key, $this->input)) {
            $this->input[$key] = [];
        }

        if($valueKey!==null){
            $this->input[$key][$valueKey] = $value;
        }
        else{
            $this->input[$key][] = $value;
        }
    }

    protected function transformInputForTransport(): array
    {
        return $this->input;
    }

    protected function getValidationRules(): array
    {
        return [];
    }

    protected function validate(): void
    {
        $rules = $this->getValidationRules();

        $validator = validator($this->input, $rules);

        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }
    }

    public function toArray(): array
    {
        $this->validate();

        return [
            'endpoint' => $this->getEndpoint(),
            'input' => $this->transformInputForTransport(),
            'mocked' => $this->getMocked(),
            'trace_id' => $this->traceId,
        ];
    }

    protected function hasTrait($traitName): bool
    {
        $traits = class_uses($this);

        return in_array($traitName, $traits);
    }

    /**
     * @param  RemoteRunnableResponse|RemoteRunnableStreamResponse  $response
     */
    public function hydrateResult($response): AINinjaResult
    {
        $content = $response->getContent();

        if (is_array($content)) {
            return $this->createResult($content);
        }

        $decoded = json_decode($content, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return $this->createResult($content);
        } else {
            return $this->createResult($decoded);
        }
    }

    public function dd()
    {
        dd($this->toArray());
    }

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
