<?php


class AcceptanceTestCest
{
	private $beforeAllSmall = <<<'EOF'
Starting : echo "Before All"
Before All
EOF;

	private $beforeAll = <<<'EOF'
Starting : echo "Before All"
Before All
Starting : Description of command
Before All with Description
Starting : echo "Before All single line"
Before All single line
Starting : Before All with Params
Before All Params
Starting : BeforeAll. fail on run but ignore errors
Command result code : 1
EOF;

	private $beforeAnySuite = <<<'EOF'
Starting : echo "Before any suite"
Before any suite
EOF;

	private $afterAnySuite = <<<'EOF'
Starting : echo "After any suite"
After any suite
EOF;

	private $afterAll = <<<'EOF'
Starting : echo "After All"
After All
EOF;

	private $beforeAcceptanceSuite = <<<'EOF'
Starting : echo "Before acceptance suite"
Before acceptance suite
EOF;

	private $afterAcceptanceSuite = <<<'EOF'
Starting : echo "After acceptance suite"
After acceptance suite
EOF;

  private $oneEnvironmentsOut = <<<'EOF'
Starting : echo "Before acceptance suite, phantom environment"
Before acceptance suite, phantom environment
EOF;

  private $twoEnvironmentsOut = <<<'EOF'
Starting : echo "Before acceptance suite, phantom,chrome environments"
Before acceptance suite, phantom,chrome environments
EOF;

  public function withoutSuitedCommandsTest(AcceptanceTester $I)
  {
		$I->runShellCommand('./vendor/bin/codecept run functional -c example --no-colors');
		$I->seeInShellOutput("Functional Tests");
		$I->dontSeeInShellOutput("Acceptance Tests");
		$I->seeInShellOutput($this->beforeAllSmall);
		$I->seeInShellOutput($this->beforeAll);
		$I->seeInShellOutput($this->beforeAnySuite);
		$I->seeInShellOutput($this->afterAnySuite);
		$I->seeInShellOutput($this->afterAll);
		$I->dontSeeInShellOutput($this->beforeAcceptanceSuite);
		$I->dontSeeInShellOutput($this->afterAcceptanceSuite);
		$I->dontSeeInShellOutput($this->twoEnvironmentsOut);
		$I->dontSeeInShellOutput($this->oneEnvironmentsOut);
  }

  public function withSuitedCommandsTest(AcceptanceTester $I)
  {
  	$I->runShellCommand('./vendor/bin/codecept run acceptance -c example --no-colors');
  	$I->dontSeeInShellOutput("Functional Tests");
  	$I->seeInShellOutput("Acceptance Tests");
  	$I->seeInShellOutput($this->beforeAllSmall);
  	$I->seeInShellOutput($this->beforeAll);
  	$I->seeInShellOutput($this->beforeAnySuite);
  	$I->seeInShellOutput($this->afterAnySuite);
  	$I->seeInShellOutput($this->afterAll);
  	$I->seeInShellOutput($this->beforeAcceptanceSuite);
  	$I->seeInShellOutput($this->afterAcceptanceSuite);
  	$I->dontSeeInShellOutput($this->twoEnvironmentsOut);
  	$I->dontSeeInShellOutput($this->oneEnvironmentsOut);
  }

  public function fullCommandsTest(AcceptanceTester $I)
  {
		$I->runShellCommand('./vendor/bin/codecept run  -c example --no-colors');
		$I->seeInShellOutput("Functional Tests");
		$I->seeInShellOutput("Acceptance Tests");
		$I->seeInShellOutput($this->beforeAllSmall);
		$I->seeInShellOutput($this->beforeAll);
		$I->seeInShellOutput($this->beforeAnySuite);
		$I->seeInShellOutput($this->afterAnySuite);
		$I->seeInShellOutput($this->afterAll);
		$I->seeInShellOutput($this->beforeAcceptanceSuite);
		$I->seeInShellOutput($this->afterAcceptanceSuite);
		$I->dontSeeInShellOutput($this->twoEnvironmentsOut);
		$I->dontSeeInShellOutput($this->oneEnvironmentsOut);
  }

	public function withSuitedEnvironmentNoCommandsTest(AcceptanceTester $I)
  {
		$I->runShellCommand('./vendor/bin/codecept run acceptance --env firefox -c example --no-colors');
		$I->dontSeeInShellOutput("Functional Tests");
		$I->seeInShellOutput("Acceptance (firefox) Tests");
		$I->seeInShellOutput($this->beforeAllSmall);
		$I->seeInShellOutput($this->beforeAll);
		$I->seeInShellOutput($this->beforeAnySuite);
		$I->seeInShellOutput($this->afterAnySuite);
		$I->seeInShellOutput($this->afterAll);
		$I->seeInShellOutput($this->beforeAcceptanceSuite);
		$I->seeInShellOutput($this->afterAcceptanceSuite);
		$I->dontSeeInShellOutput($this->twoEnvironmentsOut);
		$I->dontSeeInShellOutput($this->oneEnvironmentsOut);
  }

	public function withSuitedEnvironmentOneCommandsTest(AcceptanceTester $I)
  {
		$I->runShellCommand('./vendor/bin/codecept run acceptance --env chrome -c example --no-colors');
		$I->dontSeeInShellOutput("Functional Tests");
		$I->seeInShellOutput("Acceptance (chrome) Tests");
		$I->seeInShellOutput($this->beforeAllSmall);
		$I->seeInShellOutput($this->beforeAll);
		$I->seeInShellOutput($this->beforeAnySuite);
		$I->seeInShellOutput($this->afterAnySuite);
		$I->seeInShellOutput($this->afterAll);
		$I->seeInShellOutput($this->beforeAcceptanceSuite);
		$I->seeInShellOutput($this->afterAcceptanceSuite);
		$I->seeInShellOutput($this->twoEnvironmentsOut);
		$I->dontSeeInShellOutput($this->oneEnvironmentsOut);
  }

	public function withSuitedEnvironmentTwoCommandsTest(AcceptanceTester $I)
  {
		$I->runShellCommand('./vendor/bin/codecept run acceptance --env phantom,firefox -c example --no-colors');
		$I->dontSeeInShellOutput("Functional Tests");
		$I->seeInShellOutput("Acceptance (phantom, firefox) Tests");
		$I->seeInShellOutput($this->beforeAllSmall);
		$I->seeInShellOutput($this->beforeAll);
		$I->seeInShellOutput($this->beforeAnySuite);
		$I->seeInShellOutput($this->afterAnySuite);
		$I->seeInShellOutput($this->afterAll);
		$I->seeInShellOutput($this->beforeAcceptanceSuite);
		$I->seeInShellOutput($this->afterAcceptanceSuite);
		$I->seeInShellOutput($this->twoEnvironmentsOut);
		$I->seeInShellOutput($this->oneEnvironmentsOut);
  }

  public function withPlatformsTest(AcceptanceTester $I)
  {
		$I->runShellCommand('./vendor/bin/codecept run acceptance -c example --no-colors');
		$I->dontSeeInShellOutput("Functional Tests");
		$I->seeInShellOutput("Acceptance Tests");
		$I->seeInShellOutput(PHP_OS);
  }

}
