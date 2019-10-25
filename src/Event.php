<?php declare(strict_types=1);

namespace WS;

interface Event
{
	public function setData(EventData $data);
}