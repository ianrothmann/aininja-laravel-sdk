<?php

namespace IanRothmann\AINinja\Runners;

use IanRothmann\AINinja\Processors\AINinjaProcessor;
use IanRothmann\LangServePhpClient\RemoteRunnable;
use IanRothmann\LangServePhpClient\RemoteRunnablePool;
use IanRothmann\LangServePhpClient\Responses\RemoteRunnableBatchResponse;
use IanRothmann\LangServePhpClient\Responses\RemoteRunnableResponse;
use IanRothmann\LangServePhpClient\Responses\RemoteRunnableStreamResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class AINinjaRunner
{
    protected string $url;

    protected ?string $token;

    protected bool $shouldMock = false;

    protected bool $shouldCache = false;

    protected int $cacheDuration = 60;

    public function __construct($forceNoCache = false)
    {
        $this->url = rtrim(config('aininja.url'), '/').'/';
        $this->token = config('aininja.token');
        $this->shouldMock = config('aininja.should_mock');
        $this->shouldCache = $forceNoCache ? false : config('aininja.should_cache');
        $this->cacheDuration = config('aininja.cache_minutes');
    }

    public function invokeAsyncAndWait(array $processors): array
    {
        $runnablePool = new RemoteRunnablePool();
        $runnablePool->authenticateWithXToken($this->token);
        if($processors[0] instanceof AINinjaProcessor) {
            $sampleConfig = $processors[0]->toArray();
        }
        $runnablePool->withTraceId($sampleConfig['trace_id'] ?? null);
        $sourceHeader = $this->getSourceHeader();
        if($sourceHeader){
            $runnablePool->addHeader('X-Source', $sourceHeader);
        }
        $mockedResponses = [];
        /**
         * @var AINinjaProcessor $processor
         */
        foreach ($processors as $id => $processor) {
            $config = $processor->toArray();
            $endpoint = $this->url.ltrim($config['endpoint'], '/');
            if ($this->shouldMock) {
                $mockedResponses[$id] = RemoteRunnableResponse::mock($config['mocked']);
            } else {
                $runnablePool->invoke($id, $endpoint, $config['input']);
            }
        }

        if ($this->shouldMock) {
            return $mockedResponses;
        }

        return $runnablePool->wait();
    }

    public function invoke(AINinjaProcessor $processor): RemoteRunnableResponse
    {
        $config = $processor->toArray();
        $endpoint = $this->url.ltrim($config['endpoint'], '/');
        $runnable = new RemoteRunnable($endpoint);
        $runnable->authenticateWithXToken($this->token);
        $runnable->withTraceId($config['trace_id'] ?? null);
        $sourceHeader = $this->getSourceHeader();
        if ($sourceHeader) {
            $runnable->addHeader('X-Source', $sourceHeader);
        }
        if ($this->shouldCache) {
            $key = md5(json_encode($config));

            return Cache::remember('ai_ninja_'.$key, $this->cacheDuration, function () use ($runnable, $config) {
                return $runnable->invoke($config['input']);
            });
        } elseif ($this->shouldMock) {
            return RemoteRunnableResponse::mock($config['mocked']);
        } else {
            return $runnable->invoke($config['input']);
        }
    }

    public function stream(AINinjaProcessor $processor, $callback = null): RemoteRunnableStreamResponse
    {
        $config = $processor->toArray();
        $endpoint = $this->url.ltrim($config['endpoint'], '/');
        $runnable = new RemoteRunnable($endpoint);
        $runnable->authenticateWithXToken($this->token);
        $runnable->withTraceId($config['trace_id'] ?? null);
        $sourceHeader = $this->getSourceHeader();
        if ($sourceHeader) {
            $runnable->addHeader('X-Source', $sourceHeader);
        }

        if ($this->shouldMock) {
            return RemoteRunnableStreamResponse::mock($config['mocked']);
        } else {
            return $runnable->stream($config['input'], $callback);
        }
    }

    public function batch(array $processors): ?RemoteRunnableBatchResponse
    {
        if (count($processors) == 0) {
            return null;
        }

        $types = [];
        $configs = [];
        foreach ($processors as $processor) {
            $types[] = get_class($processor);
            $configs[] = $processor->toArray();
        }

        if (count(array_unique($types)) > 1) {
            throw new \Exception('All processors in a batch must be of the same type');
        }

        $endpoint = $this->url.ltrim($configs[0]['endpoint'], '/');
        $runnable = new RemoteRunnable($endpoint);
        $runnable->authenticateWithXToken($this->token);
        if ($configs[0]['trace_id'] ?? null) {
            $runnable->withTraceId($configs[0]['trace_id'] ?? null);
        }
        $sourceHeader = $this->getSourceHeader();
        if ($sourceHeader) {
            $runnable->addHeader('X-Source', $sourceHeader);
        }

        if ($this->shouldCache) {
            $key = md5(json_encode($configs));

            return Cache::remember('ai_ninja_'.$key, $this->cacheDuration, function () use ($runnable, $configs) {
                return $runnable->batch($configs);
            });
        } elseif ($this->shouldMock) {
            $response = new RemoteRunnableBatchResponse([]);
            foreach ($configs as $config) {
                $response->addResponse(RemoteRunnableResponse::mock($config['mocked']));
            }

            return $response;
        } else {
            $batchInputs = collect($configs)->pluck('input')->toArray();

            return $runnable->batch($batchInputs);
        }
    }

    protected function getSourceHeader(): ?string
    {
        $name = config('app.name');
        $env = config('app.env');
        if (! $name && ! $env) {
            return null;
        }

        return Str::slug($name).'-'.Str::slug($env);
    }
}
