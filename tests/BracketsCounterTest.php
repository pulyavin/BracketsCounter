<?php
class BracketsCounterTest extends \PHPUnit_Framework_TestCase {
	private function getDataOfInstance($input) {
		$bracketsCounter = new Project\BracketsCounter($input);
		return $bracketsCounter->count();
	}

	/**
	 * @dataProvider dataProvider
	 */
	public function testExpressions($input, $expected)
	{
		$result = $this->getDataOfInstance($input);

		$this->assertEquals($expected, $result);
	}

	public function dataProvider()
	{
		return [
			["a*(b+c)", "(2, 6)"],
			["(a+c)", "(0, 4)"],
			["  (   a   +  c  ) ", "(0, 4)"],
			["(a/(b+c))+d*(e-f)", "(0, 8), (3, 7), (12, 16)"],
		];
	}

	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testShouldRaseException_With_InvalidData()
	{
		$this->getDataOfInstance("(a/((b+c))+d*(e-f)");
	}
}