<?php

namespace IanRothmann\AINinja\Runners;

use IanRothmann\AINinja\Processors\AINinjaProcessor;
use IanRothmann\LangServePhpClient\RemoteRunnable;
use IanRothmann\LangServePhpClient\Responses\RemoteRunnableBatchResponse;
use IanRothmann\LangServePhpClient\Responses\RemoteRunnableResponse;
use IanRothmann\LangServePhpClient\Responses\RemoteRunnableStreamResponse;
use Illuminate\Support\Facades\Cache;

class AINinjaRunner
{
    protected string $url;

    protected string $token;

    protected bool $shouldMock = false;

    protected bool $shouldCache = false;

    protected int $cacheDuration = 60;

    public function __construct()
    {
        $this->url = rtrim(config('aininja.url'), '/').'/';
        $this->token = config('aininja.token');
        $this->shouldMock = config('aininja.should_mock');
        $this->shouldCache = config('aininja.should_cache');
        $this->cacheDuration = config('aininja.cache_minutes');
    }

    public function invoke(AINinjaProcessor $processor): RemoteRunnableResponse
    {
        $config = $processor->toArray();
        $endpoint = $this->url.ltrim($config['endpoint'], '/');
        $runnable = new RemoteRunnable($endpoint);
        $runnable->authenticateWithXToken($this->token);
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

    public function stream(AINinjaProcessor $processor): RemoteRunnableStreamResponse
    {
        $config = $processor->toArray();
        $endpoint = $this->url.ltrim($config['endpoint'], '/');
        $runnable = new RemoteRunnable($endpoint);
        $runnable->authenticateWithXToken($this->token);

        if ($this->shouldMock) {
            return RemoteRunnableStreamResponse::mock($config['mocked']);
        } else {
            return $runnable->stream($config['input'], $config['stream_callback']);
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
            return $runnable->batch($configs);
        }
    }
}
