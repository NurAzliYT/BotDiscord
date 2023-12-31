<?php

/*
 * DiscordBot, PocketMine-MP Plugin.
 *
 * Licensed under the Open Software License version 3.0 (OSL-3.0)
 * Copyright (C) 2020-present JaxkDev
 *
 * Discord :: JaxkDev
 * Email   :: JaxkDev@gmail.com
 */

namespace JaxkDev\DiscordBot\Plugin;

use function array_slice;
use function count;
use function is_string;

final class ApiResolution{

    private array $data;

    public function __construct(array $data = []){
        if(count($data) === 0 || !is_string($data[0])){
            throw new \AssertionError("Expected data for ApiResolution to contain at least a message.");
        }
        $this->data = $data;
    }

    public function getMessage(): string{
        return $this->data[0];
    }

    /**
     * See API Docs for potential data to be returned per API request.
     */
    public function getData(): array{
        return array_slice($this->data, 1);
    }
}