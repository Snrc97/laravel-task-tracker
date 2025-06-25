<?php

namespace App\Traits;

trait Cacheable
{
    public $cacheEnabled = true;
    public function withCache(string $cacheKey, callable $next, $ttl = 5)
    {
        $data = null;
        if($this->cacheEnabled)
        {
            if (cache()->has($cacheKey)) {
                $data = cache()->get($cacheKey);
                $data = json_decode($data);

            }
            $data = json_encode($next($data));
            cache()->set($cacheKey, $data, $ttl);
        }
        else
        {
            cache()->forget($cacheKey);
        }


        return $data;

    }

    public function clearCache(string $cacheKey): bool
    {
        return cache()->forget($cacheKey);
    }
}
