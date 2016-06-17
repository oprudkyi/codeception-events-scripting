<?php
/**
 * This file is part of oprudkyi/codeception-events-scripting package.
 *
 * Originally based off of Phantoman Codeception extension
 * https://github.com/site5/phantoman
 *
 * (c) 2016 Oleksii Prudkyi <Oleksii.Prudkyi@gmail.com>
 */

namespace Codeception\Extension;

use Codeception\Exception\ExtensionException;

class EventsScripting extends \Codeception\Platform\Extension
{
	// list events to listen to
	public static $events = array(
		//run before any tests
		'module.init' => 'beforeModule',

		//Before suite is executed
		'suite.before' => 'beforeSuite',

		//After suite was executed
		'suite.after' => 'afterSuite',
	);

	public function __construct($config, $options)
	{
		parent::__construct($config, $options);
	}

	public function __destruct()
	{
		$this->afterModule();
	}

	/**
	 * run command
	 */
	private function runSimpleCommand($command, $description, $ignoreErrors)
	{
		$this->writeln("Starting : {$description}");
		$lastLine = system($command, $retval);
		if($lastLine === FALSE) {
			$this->writeln("Command failed");
			if(!$ignoreErrors) {
				throw new ExtensionException($this, "Command {$command} failed");
			}
		}
		if($retval !== 0) {
			$this->writeln("Command result code : {$retval}");
			if(!$ignoreErrors) {
				throw new ExtensionException($this, "Command result code : {$retval}");
			}
		}
	}

	private function processCommand($command)
	{
		if(is_string($command)) {
			$this->runSimpleCommand($command, $command, false);
		} else if(is_array($command)) {
			//extract params
			if(!isset($command['command'])) {
				throw new ExtensionException($this, "'command' value is expected, get : \r\n" . print_r($command, true));
			}
			$commandLine = $command['command'];

			$ignoreErrors = false;
			if(isset($command['ignoreErrors'])) {
				$ignoreErrors = (bool)$command['ignoreErrors'];
			}

			if(isset($command['params'])) {
				$commandLine .= " " . $command['params'];
			}

			$description = $commandLine;
			if(isset($command['description'])) {
				$description = $command['description'];
			}

			// check if current OS is supported
			if(isset($command['platforms'])) {
				if(!$this->isPlatformSupported($command['platforms'])) {
					return;
				}
			}

			// check if environments are supported
			if(isset($command['environments'])) {
				if(!$this->isEnvironmentSupported($command['environments'])) {
					return;
				}
			}

			if(!empty($this->currentSuite) && isset($command['suites'])) {
				$suites = $command['suites'];
				if(is_string($suites)) {
					$suites = [$suites];
				}
				//skip command, it's not for current suite
				if(!in_array($this->currentSuite, $suites)
					&& !in_array($this->currentSuiteBaseName, $suites)
				) {
				return;
				}
			}

			$this->runSimpleCommand($commandLine, $description, $ignoreErrors);
		} else {
			$type = gettype($command);
			throw new ExtensionException($this, "Command type '{$type}' is not supported, string or array is expected");
		}
	}

	private function isPlatformSupported($platforms)
	{
		$platformSupported = false; // default value

		if(is_string($platforms)) {
			$platforms = [$platforms];
		}
		foreach($platforms as $platform) {
			$platformSupported = preg_match("/{$platform}/i", PHP_OS);
			if ($platformSupported) {
				break;
			}
		}
		return $platformSupported;
	}

	private function isEnvironmentSupported($environments)
	{
		$environmentSupported = false;

		// if beforeAll or afterAll then use complete list of env
		if ($this->beforeAllWereRun !== true) {
			$selectedEnvironments = $this->options['env'];
			if (!empty($selectedEnvironments)) {
				$envArray = [];
				foreach (array_unique($selectedEnvironments) as $envList) {
					$envArray = array_merge($envArray, explode(',', $envList));
				}
			} else {
				return $environmentSupported;
			}
			// else use environments from current run instance
		} else {
			$envArray = $this->currentEnvironment;
		}

		if(is_string($environments)) {
			$environments = [$environments];
		}
		foreach($environments as $environment) {
			if(in_array($environment, $envArray)) {
				$environmentSupported = true;
				break;
			}
		}

		return $environmentSupported;

	}

	/**
	 * run each command
	 */
	private function runCommands(array $commands)
	{
		foreach($commands as $command) {
			$this->processCommand($command);
		}
	}

	/**
	 * exctract and run config group (like BeforeAll)
	 */
	private function runConfigGroup($groupName)
	{
		if(!isset($this->config[$groupName])) {
			return;
		}

		$commands = &$this->config[$groupName];
		if(!is_array($commands)) {
			throw new ExtensionException($this, "EventScripting config error. {$groupName} should be array");
		}

		$this->runCommands($commands);
	}

	// methods that handle events

	private $beforeAllWereRun = false;

	/**
	 * Module Init, run before any tests
	 */
	public function beforeModule(\Codeception\Event\SuiteEvent $e)
	{
		if($this->beforeAllWereRun == false) {
			$this->runConfigGroup('BeforeAll');
			$this->beforeAllWereRun = true;
		}
	}

	//may contain environment names, like  'acceptance (phantom)' or 'acceptance (phantom, chrome)'
	private $currentSuite = '';

	//top level name - acceptance, functional
	private $currentSuiteBaseName = '';

	//array with environments enabled
	private $currentEnvironment = [];

	/**
	 * Module After, run after any tests
	 */
	public function afterModule()
	{
		$this->currentSuite = '';
		$this->currentSuiteBaseName = '';
		$this->currentEnvironment = [];
		$this->beforeAllWereRun = false;
		$this->runConfigGroup('AfterAll');
	}

	/**
	 * Before suite is executed
	 */
	public function beforeSuite(\Codeception\Event\SuiteEvent $e)
	{
		$this->currentSuite = $e->getSuite()->getName();
		$this->currentSuiteBaseName = $e->getSuite()->getBaseName();
		$settings = $e->getSettings();
		if(isset($settings['current_environment'])) {
			$this->currentEnvironment = explode(',', $settings['current_environment']);
		} else {
			$this->currentEnvironment = [];
		}
		$this->runConfigGroup('BeforeSuite');
	}

	/**
	 * After suite is executed
	 */
	public function afterSuite(\Codeception\Event\SuiteEvent $e)
	{
		$this->runConfigGroup('AfterSuite');
	}
}
