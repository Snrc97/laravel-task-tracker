<?php

namespace App\Traits;

trait Cacheable
{
    public $cacheEnabled = false;
    public function withCache(string $cacheKey, callable $next, $ttl = 5)
    {
        $data = null;
        if($this->cacheEnabled)
        {
            if (cache()->has($cacheKey)) {
                $data = cache()->get($cacheKey);
                $data = json_decode($data);
                return $data;
            }
            $data = $next($data);
            $cached = json_encode($data);
            cache()->set($cacheKey, $cached, $ttl);
        }
        else
        {
            cache()->forget($cacheKey);
            $data = $next($data);
        }


        return $data;

    }

    public function clearCache(string $cacheKey): bool
    {
        return cache()->forget($cacheKey);
    }
}
