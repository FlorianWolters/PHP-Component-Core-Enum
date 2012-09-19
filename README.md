# FlorianWolters\Component\Core\Enum

[![Build Status](https://secure.travis-ci.org/FlorianWolters/PHP-Component-Core-Enum.png?branch=master)](http://travis-ci.org/FlorianWolters/PHP-Component-Core-Enum)

**FlorianWolters\Component\Core\Enum** is a simple-to-use [PHP][17] component that provides type-safe enumerations in the [PHP][17] scripting language.

The current version is *0.3.1-stable*, which means the API may change until version *1.0.0-stable*.

## Introduction

The [PHP][17] scripting language is missing one important data type: **The enumerated type.**

Today, with version 5.4 of the [PHP][17] scripting language, there is still no linguistic support for enumerated types. It only exists a Request For Comments (RFC) from [2010-05-21][33]) that suggests adding a enum language structure.

Many programming languages, e.g. Pascal, Modula-2, Modula-3, Ada, Haskell, C, C++ und C# have an enumerated type. Java, for example, implements the enumeration type via objects (see [Java Tutorial][23] and [Java API documentation][22]).

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

(cf. [Oracle. Enums][21])

## Motivation

Since there is no *enumerated type* in [PHP][17], I decided to create my own implementation (see **Comparison** below for reasons why I don't use an already existing implementation).

My solution implements the *[Typesafe Enum][24]* pattern. The pattern has been adapted and abstracted for [PHP][17]. Because of that my implementation doesn't have the problems of the original *Typesafe Enum* pattern (see **Introduction** above):

* The enumeration constants can be used in `switch` statements (this is not possible in Java 1.5).
* It is not as verbose as the original implementation (see **Usage** below), hence less error prone.

## Features

* The abstract enumeration base class implements the *Typesafe Enum* (see [Effective Java][5] Item 21) pattern.
* An enumeration class can be placed in a [namespace][27], hence naming collisions can be avoided.
* An enumeration class can [extend][30] another enumeration class, hence an enumeration hierarchy can be built.
* Functional enumerations are supported. This means that one can use operations (method calls) on enumeration constants.
* The enumeration constants can be used in `switch` statement.
* Th enumeration constants can be serialized/unserialized via the functions [`serialize()`][31] and [`unserialize()`][32].
* Each enumeration constant is an object which is both a *Singleton* (see Design Patterns. Elements of Reusable Object-Oriented Software Item 3) and a [*ValueObject*][26]. This means that each enumeration constant is represented by only one instance and the comparison is based on the value of the enumeration constant.
* The enumeration constants cannot be instantiated via the [`new`][28] keyword.
* The enumeration constants cannot be cloned via the magic [`__clone`][29] method.
* Artifacts tested with both static and dynamic test procedures:
  * Component tests (unit tests) implemented with [PHPUnit][19].
  * Static code analysis with the style checker [PHP_CodeSniffer][14] and the source code analyzer [PHP Mess Detector (PHPMD)][18], [phpcpd][4] and [phpdcd][5].
* Provides support for the dependency manager [Composer][3].
* Provides a [PEAR package][13] which can be installed using the [PEAR installer][11]. Click [here][9] for the [PEAR channel][12].
* Provides a complete Application Programming Interface (API) documentation generated with the documentation generator [ApiGen][2]. Click [here][1] for the online API documentation.
* Follows the [PSR-0][6] requirements for autoloader interoperability.
* Follows the [PSR-1][7] basic coding style guide.
* Follows the [PSR-2][8] coding style guide.
* Follows the [Semantic Versioning][20] requirements for versioning (`<Major version>.<Minor version>.<Patch level>`).

The implementation **does not** (and **will not**) feature the following:

* Generation of enumeration classes.
* Support for [PHP][17] versions before 5.4.0.

## Roadmap/Notes

* Version *1.0.0-stable* will have a stable API.
* All `@todo` and `TODO` comments will be removed until version *1.0.0-stable*.
* Refactoring (DRY) of the unit tests.
* Improving the documentation (README.md and wiki).
* **FlorianWolters\Component\Core\Enum** is developed with the help of [Phix][16]. **This may change in the future.**

## Requirements

* [PHP][17] 5.4.0 (or later)

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

If you are creating a component that relies on **FlorianWolters\Component\Core\Enum**, please make sure that you add **FlorianWolters\Component\Core\Enum** to your component's `package.xml` file:

```xml
<dependencies>
  <required>
    <package>
      <name>Enum</name>
      <channel>http://pear.florianwolters.de</channel>
      <min>0.3.1</min>
      <max>0.3.99</max>
    </package>
  </required>
</dependencies>
```

## Usage

The best documentation for **FlorianWolters\Component\Core\Enum** are the unit tests, which are shipped in the package. You will find them installed into your [PEAR][10] repository, which on Linux systems is normally `/usr/share/php/test`.

* [Click here][1] for the API documentation of **FlorianWolters\Component\Core\Enum**.
* [Click here][0] for the Wiki of **FlorianWolters\Component\Core\Enum**.

The most important usage rule:

> Always declare the method to retrieve the enumeration constant as `final public static`.

### Best Practices

* Always declare an enumeration class as `final`, except the enumeration class should be extended by another enumeration class.
* Always add a DocBlock tag `@return` with the name of the enumeration class to each method that retrieves an enumeration constant. This enables Autocompletion in the Integrated Development Environment (IDE).

### Examples

```php
<?php
// Example 01: High dynamic and implicit, but with lower performance.
final class GenderEnum extends FlorianWolters\Component\Core\Enum\Enum {
    /** @return GenderEnum */
    final public static function FEMALE() { return self::getConstant(); }
    /** @return GenderEnum */
    final public static function MALE() { return self::getConstant(); }
}

// Example 02: High performance and explicit, but with more source code to write.
final class BooleanEnum extends FlorianWolters\Component\Core\Enum\Enum {
    /** @return BooleanEnum */
    final public static function FALSE() {
        // The first parameter can be the name of this enumeration class.
        // => The name can be retrieved via the __CLASS__ constant.
        // The second parameter can be the name of this enumeration constant.
        // => The name can be retrieved via the __FUNCTION__ constant.
        return self::getConstant(__CLASS__, __FUNCTION__);
    }
    /** @return BooleanEnum */
    final public static function TRUE() { return self::getConstant(__CLASS__, __FUNCTION__); }
}

// Example 03: Subclassed enumeration types.
// NOTE: The class GenderEnum declared above is final, change that to get this example to run.
final class ExtendedGenderEnum extends GenderEnum {
    /** @return ExtendedGenderEnum */
    final public static function HYBRID() { return self::getConstant(); }
}
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
[1]: http://blog.florianwolters.de/PHP-Component-Core-Enum
[2]: http://apigen.org
[3]: http://getcomposer.org
[4]: https://github.com/sebastianbergmann/phpcpd
[5]: https://github.com/sebastianbergmann/phpdcd
[6]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md
[7]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-1-basic-coding-standard.md
[8]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md
[9]: http://pear.florianwolters.de
[10]: http://pear.php.net
[11]: http://pear.php.net/manual/en/guide.users.commandline.cli.php
[12]: http://pear.php.net/manual/en/guide.users.concepts.channel.php
[13]: http://pear.php.net/manual/en/guide.users.concepts.package.php
[14]: http://pear.php.net/package/PHP_CodeSniffer
[15]: http://phing.info
[16]: https://github.com/stuartherbert/phix4componentdev
[17]: http://php.net "The PHP Group. PHP: Hypertext Preprocessor. 2001-2012."
[18]: http://phpmd.org
[19]: http://phpunit.de
[20]: http://semver.org
[21]: http://docs.oracle.com/javase/1.5.0/docs/guide/language/enums.html "Oracle. Enums. 2004, 2010."
[22]: http://docs.oracle.com/javase/7/docs/api/java/lang/Enum.html "Oracle. Java Platform SE 7: Enum. 1993, 2011."
[23]: http://docs.oracle.com/javase/tutorial/java/javaOO/enum.html "Oracle. The Java Tutorials: Enum Types. 1995, 2012."
[24]: http://java.sun.com/developer/Books/shiftintojava/page1.html#replaceenums
[25]: http://java.sun.com/docs/books/effective "J. Bloch. Effective Java, 2nd Edition. Boston: Addison-Wesley, 2008."
[26]: http://martinfowler.com/bliki/ValueObject.html
[27]: http://php.net/language.namespaces "The PHP Group. PHP: Namespaces. 2001-2012."
[28]: http://php.net/language.oop5.basic.php#language.oop5.basic.new
[29]: http://php.net/language.oop5.cloning.php#object.clone
[30]: http://php.net/language.oop5.inheritance "The PHP Group. PHP: Object Inheritcance. 2001-2012."
[31]: http://php.net/serialize
[32]: http://php.net/unserialize
[33]: http://wiki.php.net/rfc/enum
