# Upgrade Guide

This document describes breaking changes and how to upgrade. For a complete list of changes including minor and patch releases, please refer to the [changelog](CHANGELOG.md).

---

## [3.0.0]

**This release heavily changes the way the plugin works, due to the massive changes in DiscordPHP `v10.x`.**

**Some major API changes are documented below, but please take the time to re-read the source to fully understand all the changes.**

This update drops support for:
- PocketMine-MP `4.x` in favour of `5.x`
- PHP `8.0.x` in favour of `>8.1`
- DiscordPHP `v6.x` in favour of `v10.x`


### Storage

_! The entire plugin storage class has been removed, see below for alternatives !_

#### Bot User:

The only data we store is the bot user:
```php
/** @var \JaxkDev\DiscordBot\Models\User $bot */
$bot = $discordbot->getApi()->getBotUser();
```

#### Fetching Data:

All data is now fetched from the Discord Bot on demand. Below are some examples of how to fetch various bits of data:

It is up to you how you want to store / use this data, you can cache it etc just be aware it may become outdated if you do not reflect relevant changes from events.

##### Guilds:
```php
//Fetch all guilds bot is in:
$discordbot->getApi()->fetchGuilds()->then(function(\JaxkDev\DiscordBot\Plugin\ApiResolution $apiResolution) {
    /** @var \JaxkDev\DiscordBot\Models\Guild $guild */
    foreach ($apiResolution->getData() as $guild) {
        // Do something with $guild, async
    }
}, function (\JaxkDev\DiscordBot\Plugin\ApiRejection $rejection) {
    // Handle error
    var_dump($rejection->getMessage());
});
```
```php
//Fetch a specific guild:
$discordbot->getApi()->fetchGuild($guildId)->then(function(\JaxkDev\DiscordBot\Plugin\ApiResolution $apiResolution) {
    /** @var \JaxkDev\DiscordBot\Models\Guild $guild */
    $guild = $apiResolution->getData()[0];
    // Do something with $guild, async
}, function (\JaxkDev\DiscordBot\Plugin\ApiRejection $rejection) {
    // Handle error
    var_dump($rejection->getMessage());
});
```

##### Channels:
```php
//Fetch all channels in a guild:
$discordbot->getApi()->fetchChannels($guildId)->then(function(\JaxkDev\DiscordBot\Plugin\ApiResolution $apiResolution) {
    /** @var \JaxkDev\DiscordBot\Models\Channel $channel */
    foreach ($apiResolution->getData() as $channel) {
        // Do something with $channel, async
    }
}, function (\JaxkDev\DiscordBot\Plugin\ApiRejection $rejection) {
    // Handle error
    var_dump($rejection->getMessage());
});
```
```php
//Fetch a specific channel:
$discordbot->getApi()->fetchChannel($guildId, $channelId)->then(function(\JaxkDev\DiscordBot\Plugin\ApiResolution $apiResolution) {
    /** @var \JaxkDev\DiscordBot\Models\Channel $channel */
    $channel = $apiResolution->getData()[0];
    // Do something with $channel, async
}, function (\JaxkDev\DiscordBot\Plugin\ApiRejection $rejection) {
    // Handle error
    var_dump($rejection->getMessage());
});
```
```php
//Fetch a specific DM channel:
$discordbot->getApi()->fetchChannel(null, $userId)->then(function(\JaxkDev\DiscordBot\Plugin\ApiResolution $apiResolution) {
    /** @var \JaxkDev\DiscordBot\Models\Channel $channel */
    $channel = $apiResolution->getData()[0];
    // Do something with $channel, async
}, function (\JaxkDev\DiscordBot\Plugin\ApiRejection $rejection) {
    // Handle error
    var_dump($rejection->getMessage());
});
```

##### Members:
```php
//Fetch all members in a guild:
$discordbot->getApi()->fetchMembers($guildId)->then(function(\JaxkDev\DiscordBot\Plugin\ApiResolution $apiResolution) {
    /** @var \JaxkDev\DiscordBot\Models\Member $member */
    foreach ($apiResolution->getData() as $member) {
        // Do something with $member, async
    }
}, function (\JaxkDev\DiscordBot\Plugin\ApiRejection $rejection) {
    // Handle error
    var_dump($rejection->getMessage());
});
```
```php
//Fetch a specific member:
$discordbot->getApi()->fetchMember($guildId, $userId)->then(function(\JaxkDev\DiscordBot\Plugin\ApiResolution $apiResolution) {
    /** @var \JaxkDev\DiscordBot\Models\Member $member */
    $member = $apiResolution->getData()[0];
    // Do something with $member, async
}, function (\JaxkDev\DiscordBot\Plugin\ApiRejection $rejection) {
    // Handle error
    var_dump($rejection->getMessage());
});
```

##### Users:
```php
//Fetch all users:
$discordbot->getApi()->fetchUsers()->then(function(\JaxkDev\DiscordBot\Plugin\ApiResolution $apiResolution) {
    /** @var \JaxkDev\DiscordBot\Models\User $user */
    foreach ($apiResolution->getData() as $user) {
        // Do something with $user, async
    }
}, function (\JaxkDev\DiscordBot\Plugin\ApiRejection $rejection) {
    // Handle error
    var_dump($rejection->getMessage());
});
```
```php
//Fetch a specific user:
$discordbot->getApi()->fetchUser($userId)->then(function(\JaxkDev\DiscordBot\Plugin\ApiResolution $apiResolution) {
    /** @var \JaxkDev\DiscordBot\Models\User $user */
    $user = $apiResolution->getData()[0];
    // Do something with $user, async
}, function (\JaxkDev\DiscordBot\Plugin\ApiRejection $rejection) {
    // Handle error
    var_dump($rejection->getMessage());
});
```

##### Roles:
```php
//Fetch all roles in a guild:
$discordbot->getApi()->fetchRoles($guildId)->then(function(\JaxkDev\DiscordBot\Plugin\ApiResolution $apiResolution) {
    /** @var \JaxkDev\DiscordBot\Models\Role $role */
    foreach ($apiResolution->getData() as $role) {
        // Do something with $role, async
    }
}, function (\JaxkDev\DiscordBot\Plugin\ApiRejection $rejection) {
    // Handle error
    var_dump($rejection->getMessage());
});
```
```php
//Fetch a specific role:
$discordbot->getApi()->fetchRole($guildId, $roleId)->then(function(\JaxkDev\DiscordBot\Plugin\ApiResolution $apiResolution) {
    /** @var \JaxkDev\DiscordBot\Models\Role $role */
    $role = $apiResolution->getData()[0];
    // Do something with $role, async
}, function (\JaxkDev\DiscordBot\Plugin\ApiRejection $rejection) {
    // Handle error
    var_dump($rejection->getMessage());
});
```

##### Invites:
```php
//Fetch all invites in a guild:
$discordbot->getApi()->fetchInvites($guildId)->then(function(\JaxkDev\DiscordBot\Plugin\ApiResolution $apiResolution) {
    /** @var \JaxkDev\DiscordBot\Models\Invite $invite */
    foreach ($apiResolution->getData() as $invite) {
        // Do something with $invite, async
    }
}, function (\JaxkDev\DiscordBot\Plugin\ApiRejection $rejection) {
    // Handle error
    var_dump($rejection->getMessage());
});
```

##### Messages:
```php
//Fetch a specific message:
$discordbot->getApi()->fetchMessage($guildId, $channelId, $messageId)->then(function(\JaxkDev\DiscordBot\Plugin\ApiResolution $apiResolution) {
    /** @var \JaxkDev\DiscordBot\Models\Message $message */
    $message = $apiResolution->getData()[0];
    // Do something with $message, async
}, function (\JaxkDev\DiscordBot\Plugin\ApiRejection $rejection) {
    // Handle error
    var_dump($rejection->getMessage());
});
```
```php
//Fetch a specific message in a DM channel:
$discordbot->getApi()->fetchMessage(null, $userId, $messageId)->then(function(\JaxkDev\DiscordBot\Plugin\ApiResolution $apiResolution) {
    /** @var \JaxkDev\DiscordBot\Models\Message $message */
    $message = $apiResolution->getData()[0];
    // Do something with $message, async
}, function (\JaxkDev\DiscordBot\Plugin\ApiRejection $rejection) {
    // Handle error
    var_dump($rejection->getMessage());
});
```
```php
//Fetch all pinned messages in a channel:
$discordbot->getApi()->fetchPinnedMessages($guildId, $channelId)->then(function(\JaxkDev\DiscordBot\Plugin\ApiResolution $apiResolution) {
    /** @var \JaxkDev\DiscordBot\Models\Message $message */
    foreach ($apiResolution->getData() as $message) {
        // Do something with $message, async
    }
}, function (\JaxkDev\DiscordBot\Plugin\ApiRejection $rejection) {
    // Handle error
    var_dump($rejection->getMessage());
});
```
```php
//Fetch all pinned messages in a DM channel:
$discordbot->getApi()->fetchPinnedMessages(null, $userId)->then(function(\JaxkDev\DiscordBot\Plugin\ApiResolution $apiResolution) {
    /** @var \JaxkDev\DiscordBot\Models\Message $message */
    foreach ($apiResolution->getData() as $message) {
        // Do something with $message, async
    }
}, function (\JaxkDev\DiscordBot\Plugin\ApiRejection $rejection) {
    // Handle error
    var_dump($rejection->getMessage());
});
```

##### Webhooks:
```php
//Fetch all webhooks in a guild:
$discordbot->getApi()->fetchWebhooks($guildId)->then(function(\JaxkDev\DiscordBot\Plugin\ApiResolution $apiResolution) {
    /** @var \JaxkDev\Discord\Webhook $webhook */
    foreach ($apiResolution->getData() as $webhook) {
        // Do something with $webhook, async
    }
}, function (\JaxkDev\DiscordBot\Plugin\ApiRejection $rejection) {
    // Handle error
    var_dump($rejection->getMessage());
});
```
```php
//Fetch all webhooks in a specific channel:
$discordbot->getApi()->fetchWebhooks($guildId, $channelId)->then(function(\JaxkDev\DiscordBot\Plugin\ApiResolution $apiResolution) {
    /** @var \JaxkDev\Discord\Webhook $webhook */
    foreach ($apiResolution->getData() as $webhook) {
        // Do something with $webhook, async
    }
}, function (\JaxkDev\DiscordBot\Plugin\ApiRejection $rejection) {
    // Handle error
    var_dump($rejection->getMessage());
});
```

### Events

While the events are mostly the same, there are some changes to the data they provide and loads of new events to use !

Please individually look at the event class file you are using to see the changes if any.

#### Added Events:
- `BotUserUpdated`
- `InteractionReceived`
- `MessagesBulkDeleted`
- `ThreadCreated`
- `ThreadDeleted`
- `ThreadUpdated`
- `WebhooksUpdated`

#### Renamed Events:
- `ServerDeleted` -> `GuildDeleted`
- `ServerJoined` -> `GuildJoined`
- `ServerUpdated` -> `GuildUpdated`

#### Removed Events:
- `VoiceChannelMemberJoined`
- `VoiceChannelMemberLeft`
- `VoiceChannelMemberMoved`


### Config

The config has been adjusted to cater for new fields, any existing config from version `2.x` will automatically be
updated on server start with no user action required.

See the [HELP_ENG.txt](resources/HELP_ENG.txt) file for help with config options.


### Models

All models have undergone a massive update in order to reflect the most up-to-date discord documentation with gateway `v10`

This means various classes have been removed, updated and added. Including the use of enums for stricter types.

Please see the [Models](src/Models) directory for a full list of models and their properties, assume all Models from `v2.x` will not work without updating.


### API

The API structure has remained the same, promises and the ApiResolution/Rejection parameters have remained unchanged.

However, many functions have changed signatures. Check all of your functions against new signatures found in [Api.php](src/Plugin/Api.php)

Please note the new optional `$reason` parameter on most functions is to provide a reason for the audit log in discord.


[3.0.0]: https://github.com/DiscordBot-PMMP/DiscordBot/releases/tag/3.0.0