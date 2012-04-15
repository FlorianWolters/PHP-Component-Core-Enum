<?php
/**
 * <tt>bootstrap.php</tt>
 *
 * "Bootstrap" PHP file for PHPUnit.
 *
 * To use this "bootstrap" PHP file the Symfony2 ClassLoader Component has to be
 * installed via the PEAR Installer:
 *
 * <pre>
 * pear channel-discover pear.symfony.com
 * pear install symfony2/ClassLoader
 * </pre>
 *
 * This file is part of fwComponents.
 *
 * fwComponents is free software: you can redistribute it and/or modify it under the
 * terms of the GNU Lesser General Public License as published by the Free Software
 * Foundation, either version 3 of the License, or (at your option) any later
 * version.
 *
 * fwComponents is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A
 * PARTICULAR PURPOSE.  See the GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License along
 * with fwComponents.  If not, see http://gnu.org/licenses/lgpl.txt.
 *
 * PHP version 5.3
 *
 * @category  Test
 * @package   Bootstrap
 * @author    Florian Wolters <florian.wolters.85@googlemail.com>
 * @copyright 2011-2012 Florian Wolters
 * @license   http://gnu.org/licenses/lgpl.txt GNU Lesser General Public License
 * @version   GIT: $Id$
 * @link      http://github.com/FlorianWolters/PHPUnit-configuration
 * @since     File available since Release 1.0.0
 */

declare(encoding = 'utf-8');

use Symfony\Component\ClassLoader\UniversalClassLoader;

/**
 * Include the Symfony2 ClassLoader Component.
 */
require_once 'Symfony/Component/ClassLoader/UniversalClassLoader.php';

$autoLoader = new UniversalClassLoader;

// Registers an array of namespaces.
$autoLoader->registerNamespaces(
    array(
        'Symfony' => 'vendor/php',
        'fw' => 'src/php'
    )
);

// Register the UniversalClassLoader as an autoloader.
$autoLoader->register();
