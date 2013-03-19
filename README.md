# FlorianWolters\Component\Core\Enum

[![Build Status](https://secure.travis-ci.org/FlorianWolters/PHP-Component-Core-Enum.png?branch=master)](http://travis-ci.org/FlorianWolters/PHP-Component-Core-Enum)

**FlorianWolters\Component\Core\Enum** is a simple-to-use [PHP][17] component that provides the *Typesafe Enum* pattern.

## Table of Contents

* [Introduction](#introduction)
* [Motivation](#motivation)
* [Features](#features)
* [Requirements](#requirements)
* [Usage](#usage)
* [Installation](#installation)
  * [Local Installation](#local-installation)
  * [System-Wide Installation](#system-wide-installation)
* [As A Dependency On Your Component](#as-a-dependency-on-your-component)
  * [Composer](#composer)
  * [PEAR](#pear)
* [Development Environment](#development-environment)
* [License](#license)

## Introduction

The [PHP][17] scripting language is missing one important data type: **The enumerated type.**

Today, with version 5.4 of the [PHP][17] scripting language, there is still no linguistic support for enumerated types. It only exists a Request For Comments (RFC) from [2010-05-21][33]) that suggests adding a enum language structure.

Many programming languages, e.g. Pascal, Modula-2, Modula-3, Ada, Haskell, C, C++ und C# have an enumerated type. Java, for example, implements the enumeration type via objects (see [Java Tutorial][23] and [Java API documentation][41]).

One can use the *`int` Enum* pattern to represent an enumerated type in [PHP][17]:

```php
<?php
public const SEASON_WINTER = 0;
public const SEASON_SPRING = 1;
public const SEASON_SUMMER = 2;
public const SEASON_FALL = 3;
```

> The *`int` Enum* pattern has many (severe) problems, such as:
>
> * **Not typesafe** - Since a season is just an `int` you can pass in any other `int` value where a season is required, or add two seasons together (which makes no sense).
> * **No namespace** - You must prefix constants of an int enum with a string (in this case `SEASON_`) to avoid collisions with other int enum types.
> * **Brittleness** - Because int enums are compile-time constants, they are compiled into clients that use them. If a new constant is added between two existing constants or the order is changed, clients must be recompiled. If they are not, they will still run, but their behavior will be undefined.
> * **Printed values are uninformative** - Because they are just ints, if you print one out all you get is a number, which tells you nothing about what it represents, or even what type it is.
>
> It is possible to get around these problems by using the *Typesafe Enum* pattern (see [Effective Java][25] Item 21).
> This pattern has its own problems: It is quite verbose, hence error prone, and its enum constants cannot be used in `switch` statements.

(cf. [Oracle. Enums][40])

## Motivation

Since there is no *enumerated type* in [PHP][17], I decided to create my own implementation.

My solution implements the *[Typesafe Enum][24]* pattern. The pattern has been adapted and abstracted for [PHP][17]. Because of that, my implementation doesn't have the problems of the original *Typesafe Enum* pattern (see **[Introduction](#introduction)** above):

* The enumeration constants can be used in `switch` statements (this is not possible in Java 1.5).
* It is not as verbose as the original implementation (see **[Usage](#usage)** below), hence less error prone.

## Features

* The abstract enumeration base class implements the *Typesafe Enum* (see [Effective Java][5] Item 21) pattern.
* Supports autocompletion within an Integrated Development Environment (IDE).
* Supports functional enumerations. This means that one can use operations (method calls) on enumeration constants.
* An enumeration class can [extend][30] another enumeration class, hence an enumeration hierarchy can be built.
* The enumeration constants can be serialized/unserialized via the functions [`serialize()`][31] and [`unserialize()`][32].
* An enumeration class can be placed in a [namespace][27], hence naming collisions can be avoided.
* Each enumeration constant is an object which is
  * a *Singleton*, more precisely a *Multiton* (see Design Patterns. Elements of Reusable Object-Oriented Software Item 3)
  * and an *Immutable [ValueObject][26]*.
  This means that each enumeration constant is represented by only one instance and the comparison is based on the name of the enumeration constant.
* An enumeration constant cannot be instantiated via the [`new`][28] keyword.
* An enumeration constant cannot be cloned via the magic [`__clone`][29] method.
* Artifacts tested with both static and dynamic test procedures:
  * Dynamic component tests (unit tests) implemented using [PHPUnit][19].
  * Static code analysis performed using the following tools:
      * [PHP_CodeSniffer][14]: Style Checker
      * [PHP Mess Detector (PHPMD)][18]: Code Analyzer
      * [phpcpd][4]: Copy/Paste Detector (CPD)
      * [phpdcd][5]: Dead Code Detector (DCD)
* Installable via [Composer][3] or [PEAR installer][11]:
  * Provides a [Packagist][22] package which can be installed using the dependency manager [Composer][3].
      * Click [here][21] for the package on [Packagist][22].
  * Provides a [PEAR package][13] which can be installed using the package manager [PEAR installer][11].
      * Click [here][9] for the [PEAR channel][12].
* Provides a complete Application Programming Interface (API) documentation generated with the documentation generator [ApiGen][2].
  * Click [here][1] for the current API documentation.
* Follows the [PSR-0][6] requirements for autoloader interoperability.
* Follows the [PSR-1][7] basic coding style guide.
* Follows the [PSR-2][8] coding style guide.
* Follows the [Semantic Versioning][20] Specification (SemVer) 2.0.0-rc.1.

**FlorianWolters\Component\Core\Enum** ***does not*** (and ***will not***) feature the following:

* Generation of enumeration classes.
* Support for [PHP][17] versions <= 5.4.

## Requirements

* [PHP][17] >= 5.4
* [florianwolters/component-core-comparable][34]
* [florianwolters/component-core-debugprint][35]
* [florianwolters/component-core-equality][36]
* [florianwolters/component-core-immutable][37]
* [florianwolters/component-util-reflection][38]
* [florianwolters/component-util-singleton][39]

## Usage

The most important usage rule:

> Always declare the method to retrieve the enumeration constant as `final public static` and write the name of the method in uppercase characters.

One should follow these *best practices* when using **FlorianWolters\Component\Core\Enum**:

* Always declare an enumeration class as `final`, except the enumeration class should be extended by another enumeration class.
* Always add a DocBlock tag `@return` with the name of the enumeration class to each method that retrieves an enumeration constant. This enables Autocompletion in the Integrated Development Environment (IDE).
* Always add the suffix `Enum` to the name of a class which represents an enumeration type. This is analogical to the naming conventions for interfaces and abstract classes as described in [PSR-2][8].

The following resources contain additional information:

* [Click here][0] for the Wiki of **FlorianWolters\Component\Core\Enum**. The section **[Usage][40]** of the Wiki contains several documented source code examples.
* [Click here][1] for the API documentation of **FlorianWolters\Component\Core\Enum**.

## Installation

### Local Installation

**FlorianWolters\Component\Core\Enum** should be installed using the dependency manager [Composer][3]. [Composer][3] can be installed with [PHP][6].

    php -r "eval('?>'.file_get_contents('http://getcomposer.org/installer'));"

> This will just check a few [PHP][17] settings and then download `composer.phar` to your working directory. This file is the [Composer][3] binary. It is a PHAR ([PHP][17] archive), which is an archive format for [PHP][17] which can be run on the command line, amongst other things.
>
> Next, run the `install` command to resolve and download dependencies:

    php composer.phar install

### System-Wide Installation

**FlorianWolters\Component\Core\Enum** should be installed using the [PEAR installer][11]. This installer is the [PHP][17] community's de-facto standard for installing [PHP][17] components.

    pear channel-discover http://pear.florianwolters.de
    pear install --alldeps fw/Enum

## As A Dependency On Your Component

### Composer

If you are creating a component that relies on **FlorianWolters\Component\Core\Enum**, please make sure that you add **FlorianWolters\Component\Core\Enum** to your component's `composer.json` file:

```json
{
    "require": {
        "florianwolters/component-core-enum": "0.4.*"
    }
}
```

### PEAR

If you are creating a component that relies on **FlorianWolters\Component\Core\Enum**, please make sure that you add **FlorianWolters\Component\Core\Enum** to your component's `package.xml` file:

```xml
<dependencies>
  <required>
    <package>
      <name>Enum</name>
      <channel>http://pear.florianwolters.de</channel>
      <min>0.4.0</min>
      <max>0.4.99</max>
    </package>
  </required>
</dependencies>
```

## Development Environment

If you want to patch or enhance this component, you will need to create a suitable development environment. The easiest way to do that is to install [phix4componentdev][16]:

    # phix4componentdev
    pear channel-discover pear.phix-project.org
    pear install phix/phix4componentdev

You can then clone the Git repository:

    # PHP-Component-Core-Enum
    git clone https://github.com/florianwolters/PHP-Component-Core-Enum

Then, install a local copy of this component's dependencies to complete the development environment:

    # build vendor/ folder
    phing build-vendor

To make life easier for you, common tasks (such as running unit tests, generating code review analytics, and creating the [PEAR package][13]) have been automated using [phing][15]. You'll find the automated steps inside the `build.xml` file that ships with the component.

Run the command `phing` in the component's top-level folder to see the full list of available automated tasks.

## License

This program is free software: you can redistribute it and/or modify it under the terms of the GNU Lesser General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU Lesser General Public License for more details.

You should have received a copy of the GNU Lesser General Public License along with this program. If not, see <http://gnu.org/licenses/lgpl.txt>.

[0]: http://github.com/FlorianWolters/PHP-Component-Core-Enum/wiki
     "Home · FlorianWolters/PHP-Component-Core-Enum Wiki"
[1]: http://blog.florianwolters.de/PHP-Component-Core-Enum
     "FlorianWolters\Component\Core\Enum | Application Programming Interface (API) documentation"
[2]: http://apigen.org
     "ApiGen | API documentation generator for PHP 5.3.+"
[3]: http://getcomposer.org
     "Composer"
[4]: https://github.com/sebastianbergmann/phpcpd
     "sebastianbergmann/phpcpd · GitHub"
[5]: https://github.com/sebastianbergmann/phpdcd
     "sebastianbergmann/phpdcd · GitHub"
[6]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md
     "PSR-0 requirements for autoloader interoperability"
[7]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md
     "PSR-1 basic coding style guide"
[8]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md
     "PSR-2 coding style guide"
[9]: http://pear.florianwolters.de
     "PEAR channel of Florian Wolters"
[10]: http://pear.php.net
      "PEAR - PHP Extension and Application Repository"
[11]: http://pear.php.net/manual/en/guide.users.commandline.cli.php
      "Manual :: Command line installer (PEAR)"
[12]: http://pear.php.net/manual/en/guide.users.concepts.channel.php
      "Manual :: PEAR Channels"
[13]: http://pear.php.net/manual/en/guide.users.concepts.package.php
      "Manual :: PEAR Packages"
[14]: http://pear.php.net/package/PHP_CodeSniffer
      "PHP_CodeSniffer"
[15]: http://phing.info
      "Phing"
[16]: https://github.com/stuartherbert/phix4componentdev
      "stuartherbert/phix4componentdev · GitHub"
[17]: http://php.net
      "PHP: Hypertext Preprocessor"
[18]: http://phpmd.org
      "PHPMD - PHP Mess Detector"
[19]: http://phpunit.de
      "sebastianbergmann/phpunit · GitHub"
[20]: http://semver.org
      "Semantic Versioning"
[21]: http://packagist.org/packages/florianwolters/component-core-enum
      "florianwolters/component-core-enum - Packagist"
[22]: http://packagist.org
      "Packagist"
[40]: http://docs.oracle.com/javase/7/docs/technotes/guides/language/enums.html
      "Oracle. Enums. 1993, 2013."
[41]: http://docs.oracle.com/javase/7/docs/api/java/lang/Enum.html
      "Oracle. Java Platform SE 7: Enum. 1993, 2013."
[23]: http://docs.oracle.com/javase/tutorial/java/javaOO/enum.html
      "Oracle. The Java Tutorials: Enum Types. 1995, 2013."
[24]: http://jcp.org/aboutJava/communityprocess/jsr/tiger/enum.html
      "Sun Microsystems, Inc.. A Typesafe Enum Facility for the Java Programming Language. 2012."
[25]: http://oracle.com/technetwork/java/effectivejava-136174.html
      "J. Bloch. Effective Java, 2nd Edition. Boston: Addison-Wesley, 2008."
[26]: http://martinfowler.com/bliki/ValueObject.html
      "M. Fowler. Value Object."
[27]: http://php.net/language.namespaces
      "The PHP Group. PHP: Namespaces. 2001-2013."
[28]: http://php.net/language.oop5.basic.php#language.oop5.basic.new
      "The PHP Group. PHP: The Basics. 2001-2013."
[29]: http://php.net/language.oop5.cloning.php#object.clone
      "The PHP Group. PHP: Object Cloning. 2001-2013."
[30]: http://php.net/language.oop5.inheritance
      "The PHP Group. PHP: Object Inheritcance. 2001-2013."
[31]: http://php.net/serialize
      "The PHP Group. PHP: serialize. 2001-2013."
[32]: http://php.net/unserialize
      "The PHP Group. PHP: unserialize. 2001-2013."
[33]: http://wiki.php.net/rfc/enum
      "The PHP Group. PHP: rfc:enum [PHP Wiki]. 2001-2013."
[34]: https://github.com/FlorianWolters/PHP-Component-Core-Comparable
      "FlorianWolters/PHP-Component-Core-Comparable · GitHub"
[35]: https://github.com/FlorianWolters/PHP-Component-Core-DebugPrint
      "FlorianWolters/PHP-Component-Core-DebugPrint · GitHub"
[36]: https://github.com/FlorianWolters/PHP-Component-Core-Equality
      "FlorianWolters/PHP-Component-Core-Equality · GitHub"
[37]: https://github.com/FlorianWolters/PHP-Component-Core-Immutable
      "FlorianWolters/PHP-Component-Core-Immutable · GitHub"
[38]: https://github.com/FlorianWolters/PHP-Component-Util-Reflection
      "FlorianWolters/PHP-Component-Util-Reflection · GitHub"
[39]: https://github.com/FlorianWolters/PHP-Component-Util-Singleton
      "FlorianWolters/PHP-Component-Util-Singleton · GitHub"
[40]: http://github.com/FlorianWolters/PHP-Component-Core-Enum/wiki/Usage
     "Usage · FlorianWolters/PHP-Component-Core-Enum Wiki"
