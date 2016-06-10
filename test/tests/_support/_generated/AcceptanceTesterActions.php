<?php  //[STAMP] fb5e2c5ddff7b97809c8252eebc72d43
namespace _generated;

// This class was automatically generated by build task
// You should not change it manually as it will be overwritten on next build
// @codingStandardsIgnoreFile

use Helper\Acceptance;
use Codeception\Module\Cli;

trait AcceptanceTesterActions
{
    /**
     * @return \Codeception\Scenario
     */
    abstract protected function getScenario();

    
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Executes a shell command.
     * Fails If exit code is > 0. You can disable this by setting second parameter to false
     *
     * ```php
     * <?php
     * $I->runShellCommand('phpunit');
     *
     * // do not fail test when command fails
     * $I->runShellCommand('phpunit', false);
     * ```
     *
     * @param $command
     * @param bool $failNonZero
     * @see \Codeception\Module\Cli::runShellCommand()
     */
    public function runShellCommand($command, $failNonZero = null) {
        return $this->getScenario()->runStep(new \Codeception\Step\Action('runShellCommand', func_get_args()));
    }

 
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks that output from last executed command contains text
     *
     * @param $text
     * Conditional Assertion: Test won't be stopped on fail
     * @see \Codeception\Module\Cli::seeInShellOutput()
     */
    public function canSeeInShellOutput($text) {
        return $this->getScenario()->runStep(new \Codeception\Step\ConditionalAssertion('seeInShellOutput', func_get_args()));
    }
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks that output from last executed command contains text
     *
     * @param $text
     * @see \Codeception\Module\Cli::seeInShellOutput()
     */
    public function seeInShellOutput($text) {
        return $this->getScenario()->runStep(new \Codeception\Step\Assertion('seeInShellOutput', func_get_args()));
    }

 
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks that output from latest command doesn't contain text
     *
     * @param $text
     *
     * Conditional Assertion: Test won't be stopped on fail
     * @see \Codeception\Module\Cli::dontSeeInShellOutput()
     */
    public function cantSeeInShellOutput($text) {
        return $this->getScenario()->runStep(new \Codeception\Step\ConditionalAssertion('dontSeeInShellOutput', func_get_args()));
    }
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     * Checks that output from latest command doesn't contain text
     *
     * @param $text
     *
     * @see \Codeception\Module\Cli::dontSeeInShellOutput()
     */
    public function dontSeeInShellOutput($text) {
        return $this->getScenario()->runStep(new \Codeception\Step\Assertion('dontSeeInShellOutput', func_get_args()));
    }

 
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     *
     * Conditional Assertion: Test won't be stopped on fail
     * @see \Codeception\Module\Cli::seeShellOutputMatches()
     */
    public function canSeeShellOutputMatches($regex) {
        return $this->getScenario()->runStep(new \Codeception\Step\ConditionalAssertion('seeShellOutputMatches', func_get_args()));
    }
    /**
     * [!] Method is generated. Documentation taken from corresponding module.
     *
     *
     * @see \Codeception\Module\Cli::seeShellOutputMatches()
     */
    public function seeShellOutputMatches($regex) {
        return $this->getScenario()->runStep(new \Codeception\Step\Assertion('seeShellOutputMatches', func_get_args()));
    }
}