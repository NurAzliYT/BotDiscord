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

namespace JaxkDev\DiscordBot\Plugin\Events;

use JaxkDev\DiscordBot\Plugin\Utils;
use pocketmine\plugin\Plugin;

/**
 * Emitted when a webhook(s) in the specified guild/channel has been updated
 */
final class WebhooksUpdated extends DiscordBotEvent{

    private string $guild_id;

    private string $channel_id;

    public function __construct(Plugin $plugin, string $guild_id, string $channel_id){
        parent::__construct($plugin);
        if(!Utils::validDiscordSnowflake($guild_id)){
            throw new \AssertionError("Invalid guild ID given.");
        }
        if(!Utils::validDiscordSnowflake($channel_id)){
            throw new \AssertionError("Invalid channel ID given.");
        }
        $this->guild_id = $guild_id;
        $this->channel_id = $channel_id;
    }

    public function getGuildId(): string{
        return $this->guild_id;
    }

    public function getChannelId(): string{
        return $this->channel_id;
    }
}