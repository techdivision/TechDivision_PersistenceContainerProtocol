<?php

/**
 * TechDivision\PersistenceContainerProtocol\BeanContext
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * PHP version 5
 *
 * @category  Library
 * @package   TechDivision_PersistenceContainerProtocol
 * @author    Tim Wagner <tw@techdivision.com>
 * @copyright 2014 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/TechDivision_PersistenceContainerProtocol
 * @link      http://www.appserver.io
 */

namespace TechDivision\PersistenceContainerProtocol;

use TechDivision\Application\Interfaces\ManagerInterface;
use TechDivision\PersistenceContainerProtocol\RemoteMethod;

/**
 * The interface for the bean manager registered for the application.
 *
 * @category  Library
 * @package   TechDivision_PersistenceContainerProtocol
 * @author    Tim Wagner <tw@techdivision.com>
 * @copyright 2014 TechDivision GmbH <info@techdivision.com>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/techdivision/TechDivision_PersistenceContainerProtocol
 * @link      http://www.appserver.io
 */
interface BeanContext extends ManagerInterface
{

    /**
     * The unique identifier to be registered in the application context.
     *
     * @var string
     */
    const IDENTIFIER = 'TechDivision\PersistenceContainerProtocol\BeanContext';

    /**
     * Returns the absolute path to the web application.
     *
     * @return string The absolute path
     */
    public function getWebappPath();

    /**
     * Tries to locate the queue that handles the request and returns the instance
     * if one can be found.
     *
     * @param \TechDivision\PersistenceContainerProtocol\RemoteMethod $remoteMethod The remote method call
     * @param array                                                   $args         The arguments passed to the session beans constructor
     *
     * @return object The requested bean instance
     */
    public function locate(RemoteMethod $remoteMethod, array $args = array());

    /**
     * Attaches the passed bean, depending on it's type to the container.
     *
     * @param object $instance  The bean instance to attach
     * @param string $sessionId The session-ID when we have stateful session bean
     *
     * @return void
     * @throws \Exception Is thrown if we have a stateful session bean, but no session-ID passed
     */
    public function attach($instance, $sessionId = null);

    /**
     * Returns a reflection class intance for the passed class name.
     *
     * @param string $className The class name to return the reflection instance for
     *
     * @return \ReflectionClass The reflection instance
     */
    public function newReflectionClass($className);

    /**
     * Returns a new instance of the passed class name.
     *
     * @param string $className The fully qualified class name to return the instance for
     * @param array  $args      Arguments to pass to the constructor of the instance
     *
     * @return object The instance itself
     * @todo Has to be refactored to avoid registering autoloader on every call
     */
    public function newInstance($className, array $args = array());
}
