<?php

/**
 * Copyright (c) Vincent Klaiber.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @see https://github.com/vinkla/laravel-hashids
 */

declare(strict_types=1);

namespace Vinkla\Hashids;

use Hashids\Hashids;
use Illuminate\Support\Arr;

class HashidsFactory
{
    public function make(array $config, string $key = 'panelv3'): Hashids
    {
        $config = $this->getConfig($config, $key);

        return $this->getClient($config);
    }

    protected function getConfig(array $config, string $key): array
    {
        return [
            'salt'      => $key,
            'length'    => Arr::get($config, 'length', 0),
            'alphabet'  => Arr::get($config, 'alphabet', 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890'),
        ];
    }

    protected function getClient(array $config): Hashids
    {
        return new Hashids($config['salt'], $config['length'], $config['alphabet']);
    }
}
