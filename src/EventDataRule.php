<?php declare(strict_types=1);

namespace WS;

use PfmScraper\Exception\Exception;
use PhpParser\Node\Expr;
use PhpParser\Node\Expr\BooleanNot;
use PhpParser\Node\Expr\Instanceof_;
use PhpParser\Node\Stmt\If_;

class EventDataRule implements \PHPStan\Rules\Rule
{

	/**
	 * @return string Class implementing \PhpParser\Node
	 */
	public function getNodeType(): string
	{
		return \PHPStan\Node\InClassMethodNode::class;
	}

	/**
	 * @param \PHPStan\Node\InClassMethodNode $node
	 * @param \PHPStan\Analyser\Scope $scope
	 * @return (string|RuleError)[] errors
	 */
	public function processNode(\PhpParser\Node $node, \PHPStan\Analyser\Scope $scope): array
	{
		$orgNode = $node->getOriginalNode();
		$stmts = $orgNode->stmts;
		$fn = $scope->getFunction();
		if ($fn->getName() !== 'setData') {
			return [];
		}
		$classRfl = $scope->getClassReflection();
		if (!$classRfl->getNativeReflection()->implementsInterface(Event::class)) {
			return [];
		}
		if (count($stmts) === 0) {
			return ['Should be a EventData check'];
		}
		$firstStmt = $stmts[0];
		if (!$firstStmt instanceof If_)  {
			return ['EventData at first!'];
		}
		$cond = $firstStmt->cond;
		if (!$cond instanceof BooleanNot) {
			return ['Please check EventData check with !'];
		}
		$instanceOf = $cond->expr;
		if (!$instanceOf instanceof Instanceof_) {
			return ['Please check EventData check with instanceof'];
		}
		$class = $instanceOf->class;
		if ($class instanceof Expr) {
			return ['Aaaahr... Expr'];
		}
		$targetName = $classRfl->getName() . 'Data';
		if ($class->toString() !== $targetName ) {
			return ['Name it '.$targetName];
		}

		return [];
	}
}