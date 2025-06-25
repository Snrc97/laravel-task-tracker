<?php

namespace App\Traits;

trait Cacheable
{
    public $cacheEnabled = true;
    public function withCache(string $cacheKey, callable $next, $ttl = 5)
    {
        $data = null;
        if(!$this->cacheEnabled)
        {
            if (cache()->has($cacheKey)) {
                $data = cache()->get($cacheKey);
            }
            cache()->set($cacheKey, $next(), $ttl);
        }
        else
        {
            cache()->forget($cacheKey);
        }


        return $next($data);

    }

    public function clearCache(string $cacheKey): bool
    {
        return cache()->forget($cacheKey);
    }
}
