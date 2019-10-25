<?php declare(strict_types=1);


namespace WS;


use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;

class EventDataRuleTest extends RuleTestCase
{
	protected function getRule(): Rule
	{
		return new EventDataRule();
	}

	public function testRule(): void
	{
		$this->analyse([__DIR__.'/MyEvent.php'], [
			[
				'Name it WS\MyEvent2Data',
				23
			]
		]);
	}
}