<?php

/*
 * This file is part of the symfony framework.
 *
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

/**
 * sfServiceContainerLoader is the abstract class used by all built-in loaders.
 *
 * @package    symfony
 * @subpackage service
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfServiceContainerLoader.php 267 2009-03-26 19:56:18Z fabien $
 */
abstract class sfServiceContainerLoader implements sfServiceContainerLoaderInterface
{
  protected $container;

  /**
   * Constructor.
   *
   * @param sfServiceContainerBuilder $container A sfServiceContainerBuilder instance
   */
  public function __construct(sfServiceContainerBuilder $container = null)
  {
    $this->container = $container;
  }

  /**
   * Loads a resource.
   *
   * @param mixed $resource The resource path
   */
  public function load($resource)
  {
    if (!$this->container)
    {
      throw new LogicException('You must attach the loader to a service container.');
    }

    list($definitions, $parameters) = $this->doLoad($resource);

    $this->container->setServiceDefinitions($definitions);

    $currentParameters = $this->container->getParameters();
    foreach ($parameters as $key => $value)
    {
      $this->container->setParameter($key, $this->container->resolveValue($value));
    }
    $this->container->addParameters($currentParameters);
  }

  /**
   * Loads a resource.
   *
   * @param  mixed $resource The resource path
   *
   * @return array An array of definitions and parameters
   */
  abstract public function doLoad($resource);
}
