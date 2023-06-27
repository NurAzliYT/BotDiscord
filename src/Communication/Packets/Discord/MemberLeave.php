<?php
/*
 * DiscordBot, PocketMine-MP Plugin.
 *
 * Licensed under the Open Software License version 3.0 (OSL-3.0)
 * Copyright (C) 2020-present JaxkDev
 *
 * Twitter :: @JaxkDev
 * Discord :: JaxkDev
 * Email   :: JaxkDev@gmail.com
 */

namespace JaxkDev\DiscordBot\Communication\Packets\Discord;

use JaxkDev\DiscordBot\Communication\Packets\Packet;

class MemberLeave extends Packet{

    private string $member_id;

    public function __construct(string $member_id){
        parent::__construct();
        $this->member_id = $member_id;
    }

    public function getMemberID(): string{
        return $this->member_id;
    }

    public function __serialize(): array{
        return [
            $this->UID,
            $this->member_id
        ];
    }

    public function __unserialize(array $data): void{
        [
            $this->UID,
            $this->member_id
        ] = $data;
    }
}