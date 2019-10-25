<?php declare(strict_types=1);

namespace WS;

class MyEvent implements Event
{
	/** @var EventData */
	private $data;

	public function setData(EventData $data)
	{
		if (!$data instanceof ThisEventData) {
			throw new \RuntimeException();
		}
	}
}