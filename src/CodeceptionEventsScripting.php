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

		/*
        'test.before' => 'beforeTest',
        'step.before' => 'beforeStep',
        'test.fail' => 'testFailed',
        'result.print.after' => 'print',
		*/
    );

	public function __construct($config, $options)
    {
        parent::__construct($config, $options);
	}

	public function __destruct()
    {
		$this->afterModule();
    }

    // methods that handle events
    /**
     * Module Init, run before any tests
     */
    public function beforeModule(\Codeception\Event\SuiteEvent $e)
    {	
	}
	
	/**
     * Module After, run after any tests
     */
    public function afterModule()
    {	
	}
	
	/**
     * Before suite is executed
     */
	public function beforeSuite(\Codeception\Event\SuiteEvent $e) 
	{
	}

    /**
     * After suite is executed
     */
	public function afterSuite(\Codeception\Event\SuiteEvent $e) 
	{
	}

	/*
    public function beforeTest(\Codeception\Event\TestEvent $e) {}

    public function beforeStep(\Codeception\Event\StepEvent $e) {}

    public function testFailed(\Codeception\Event\FailEvent $e) {}

	public function AfterPrint(\Codeception\Event\PrintResultEvent $e) {}
	 */
}
