<?php declare(strict_types=1);

namespace WS;

class MyEvent1 implements Event
{
	/** @var EventData */
	private $data;

	public function setData(EventData $data)
	{
		if (!$data instanceof MyEvent1Data) {
			throw new \RuntimeException();
		}
	}
}

class MyEvent2 implements Event
{
	/** @var EventData */
	private $data;

	public function setData(EventData $data)
	{
		if (!$data instanceof MyEvent1Data) {
			throw new \RuntimeException();
		}
	}
}