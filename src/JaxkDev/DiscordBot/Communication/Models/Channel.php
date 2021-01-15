<?php
/*
 * DiscordBot, PocketMine-MP Plugin.
 *
 * Licensed under the Open Software License version 3.0 (OSL-3.0)
 * Copyright (C) 2020-2021 JaxkDev
 *
 * Twitter :: @JaxkDev
 * Discord :: JaxkDev#2698
 * Email   :: JaxkDev@gmail.com
 */

namespace JaxkDev\DiscordBot\Communication\Models;

class Channel implements \Serializable{

	const
		TYPE_TEXT = 0,
		TYPE_VOICE = 1;

	/** @var string */
	private $id;

	/** @var string */
	private $name;

	/** @var string|null */
	private $category;

	///** @var int */
	//private $type = self::TYPE_TEXT;
	//TODO, abstract class and make parents, TextChannel, VoiceChannel, CategoryChannel, DmChannel...

	/** @var string|null */
	private $description;

	/** @var string */
	private $server_id;

	public function getId(): string{
		return $this->id;
	}

	public function setId(string $id): Channel{
		$this->id = $id;
		return $this;
	}

	public function getName(): string{
		return $this->name;
	}

	public function setName(string $name): Channel{
		$this->name = $name;
		return $this;
	}

	// No setType, intentional.
	/*
	public function getType(): int{
		return $this->type;
	}*/

	public function getDescription(): ?string{
		return $this->description;
	}

	public function setDescription(?string $description): Channel{
		$this->description = $description;
		return $this;
	}

	public function getCategory(): ?string{
		return $this->category;
	}

	public function setCategory(?string $category): Channel{
		$this->category = $category;
		return $this;
	}

	public function getServerId(): string{
		return $this->server_id;
	}

	public function setServerId(string $server_id): Channel{
		$this->server_id = $server_id;
		return $this;
	}

	//----- Serialization -----//

	public function serialize(): ?string{
		return serialize([
			$this->id,
			$this->name,
			$this->category,
			$this->description,
			$this->server_id
		]);
	}

	public function unserialize($serialized): void{
		[
			$this->id,
			$this->name,
			$this->category,
			$this->description,
			$this->server_id
		] = unserialize($serialized);
	}
}