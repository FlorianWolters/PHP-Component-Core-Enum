fw\Component\Core\Enum
======================

*fw\Component\Core\Enum* is a simple-to-use PHP component that provides type-safe enumerations in the PHP scripting language.

The current version is *0.1.0-beta*, which means the API may change until version *1.0.0-stable*.

Although the current version tag is *0.1.0-beta*, the function of this component an be considered as stable. (Hint: The component has a code coverage via unit tests of 100%.)

Introduction
------------

The [PHP][4] scripting language is missing one important data type: **The enumerated type.**

Today, with version 5.4 of the PHP scripting language, there is still no linguistic support for enumerated types. It only exists a Request For Comments (RFC) from [2010-05-21](http://wiki.php.net/rfc/enum) that suggests adding a enum language structure.

Many programming languages, e.g. Pascal, Modula-2, Modula-3, Ada, Haskell, C, C++ und C# have an enumerated type. Java, for example, implements the enumeration type via objects (see [Java Tutorial][2] and [Java API documentation][3]).

One can use the *`int` Enum* pattern to represent an enumerated type in PHP:

    <?php
    public const SEASON_WINTER = 0;
    public const SEASON_SPRING = 1;
    public const SEASON_SUMMER = 2;
    public const SEASON_FALL = 3;

> The *`int` Enum* pattern has many (severe) problems, such as:
>
> * **Not typesafe** - Since a season is just an `int` you can pass in any other `int` value where a season is required, or add two seasons together (which makes no sense).
> * **No namespace** - You must prefix constants of an int enum with a string (in this case `SEASON_`) to avoid collisions with other int enum types.
> * **Brittleness** - Because int enums are compile-time constants, they are compiled into clients that use them. If a new constant is added between two existing constants or the order is changed, clients must be recompiled. If they are not, they will still run, but their behavior will be undefined.
> * **Printed values are uninformative** - Because they are just ints, if you print one out all you get is a number, which tells you nothing about what it represents, or even what type it is.
>
> It is possible to get around these problems by using the *Typesafe Enum* pattern (see [Effective Java][5] Item 21).
> This pattern has its own problems: It is quite verbose, hence error prone, and its enum constants cannot be used in `switch` statements.

(cf. [Oracle. Enums, 2004][1])

Motivation
----------

Since there is no *enumerated type* in PHP, I decided to create my own implementation (see **Comparison** below for reasons why I don't use an already existing implementation).

My solution implements the *[Typesafe Enum][6]* pattern. The pattern has been adapted and abstracted for PHP. Because of that my implementation doesn't have the problems of the *Typesafe Enum* pattern (see **Introduction** above):

* The enumeration constants can be used in `switch` statements (this is not possible in Java 1.5).
* It is not as verbose as the original implementation (see **Usage** below), hence less error prone.

Features
--------

* The abstract enumeration base class implements the *Typesafe Enum* (see [Effective Java][5] Item 21) pattern.
* An enumeration class can be placed in a [namespace][7], hence naming collisions can be avoided.
* An enumeration class can [extend][8] another enumeration class, hence an enumeration hierarchy can be built.
* The enumeration constants can be used in `switch` statement.
* Th enumeration constants can be serialized/unserialized via the functions [`\serialize()`](http://php.net/serialize) and [`\unserialize()`](http://php.net/unserialize).
* Each enumeration constant is an object which is both a *Singleton* (see Design Patterns. Elements of Reusable Object-Oriented Software Item 3) and a [*ValueObject*](http://martinfowler.com/bliki/ValueObject.html). This means that each enumeration constant is represented by only one instance and the comparison is based on the value of the enumeration constant.
* The enumeration constants cannot be instantiated via the [`new`](http://php.net/language.oop5.basic.php#language.oop5.basic.new) keyword.
* The enumeration constants cannot be cloned via the magic [`__clone`](http://php.net/language.oop5.cloning.php#object.clone) method.
* Tested with both static and dynamic test procedures:
    * Unit tests implemented in [PHPUnit](http://phpunit.de) (100% code coverage).
    * Static code analysis with [PHP Mess Detector (PHPMD)](http://phpmd.org) and [PHP_CodeSniffer](http://pear.php.net/package/PHP_CodeSniffer).
* Application Programming Interface (API) documentation generated with [ApiGen](http://apigen.org).
* Follows the [PSR-0](http://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md) specification.
* Follows the [Semantic Versioning](http://semver.org) specification (\<Major version\>.\<Minor version\>.\<Patch level\>).

The implementation **does not** (and **will not**) feature the following:

* Generation of enumeration classes.
* Support for PHP versions older than 5.3.

[1]: http://docs.oracle.com/javase/1.5.0/docs/guide/language/enums.html "Oracle. Enums, 2004."
[2]: http://docs.oracle.com/javase/tutorial/java/javaOO/enum.html
[3]: http://docs.oracle.com/javase/7/docs/api/java/lang/Enum.html
[4]: http://php.net "The PHP Group. PHP: Hypertext Preprocessor, 2001-2012."
[5]: http://java.sun.com/docs/books/effective
[6]: http://java.sun.com/developer/Books/shiftintojava/page1.html#replaceenums
[7]: http://php.net/language.namespaces "The PHP Group. PHP: Namespaces, 2001-2012."
[8]: http://php.net/language.oop5.inheritance "The PHP Group. PHP: Object Inheritcance, 2001-2012."

Roadmap/Notes
-------------

* Version *1.0.0-stable* will have a stable API.
* Version *1.0.0-stable* will require PHP 5.4.
* Functional enumerations will be supported in version *1.0.0-stable*.
* `@todo` comments will be fixed and/or removed until version *1.0.0-stable*.
* *fw\Component\Core\Enum* is developed with the help of [Phix](http://phix-project.org). **This may change in the future.**

Requirements
------------

* [PHP](http://php.net) 5.3.0 (or later)
    **NOTICE:** Version *1.0.0-stable* will require PHP 5.4 (or later).
* [Symfony 2 ClassLoader Component](http://symfony.com/doc/current/components/class_loader.html) 2.0.12
    **NOTICE:** The *ClassLoader Component* is automatically installed if *fw\Component\Core\Enum* is installed using the [PEAR Installer](http://pear.php.net).

System-Wide Installation
------------------------

*fw\Component\Core\Enum* should be installed using the [PEAR Installer](http://pear.php.net). This installer is the PHP community's de-facto standard for installing PHP components.

    sudo pear channel-discover http://florianwolters.github.com/pear
    sudo pear install --alldeps fw/Enum

As A Dependency On Your Component
---------------------------------

If you are creating a component that relies on *fw\Component\Core\Enum*, please make sure that you add *fw\Component\Core\Enum* to your component's `package.xml` file:

```xml
<dependencies>
  <required>
    <package>
      <name>Enum</name>
      <channel>http://florianwolters.github.com/pear</channel>
      <min>0.1.0</min>
      <max>0.1.9</max>
    </package>
  </required>
</dependencies>
```

Usage
-----

The best documentation for *fw\Component\Core\Enum* are the unit tests, which are shipped in the package. You will find them installed into your PEAR repository, which on Linux systems is normally `/usr/share/php/test`.

[Click here](http://florianwolters.github.com/PHP-Component-Core-Enum) for the API documentation of *fw\Component\Core\Enum*.

#### Best Practices

* Always declare an enumeration class as `final`, except the enumeration class should be extended by another enumeration class.
* Always declare the method to retrieve the enumeration constant as `static final`.
* Always add a DocBlock tag `@return` with the name of the enumeration class to each method that retrieves an enumeration constant. This enables Autocompletion in the Integrated Development Environment (IDE).

#### Examples

```php
<?php
// Example 01: High dynamic and implicit, but with lower performance.
final class GenderEnum extends fw\Component\Core\Enum\Enum {
    /** @return GenderEnum */
    public static final function FEMALE() { return self::getConstant(); }
    /** @return GenderEnum */
    public static final function MALE() { return self::getConstant(); }
}

// Example 02: High performance and explicit, but with more source code to write.
final class BooleanEnum extends fw\Component\Core\Enum\Enum {
    /** @return BooleanEnum */
    public static final function FALSE() {
        // The first parameter can be the name of this enumeration class.
        // => The name can be retrieved via the __CLASS__ constant.
        // The second parameter can be the name of this enumeration constant.
        // => The name can be retrieved via the __FUNCTION__ constant.
        return self::getConstant(__CLASS__, __FUNCTION__);
    }
    /** @return BooleanEnum */
    public static final function TRUE() { return self::getConstant(__CLASS__, __FUNCTION__); }
}

// Example 03: Subclassed enumeration types.
// NOTE: The class GenderEnum declared above is final, change that to get this example to compile.
final class ExtendedGenderEnum extends GenderEnum {
    /** @return ExtendedGenderEnum */
    public static final function HYBRID() { return self::getConstant(); }
}
```

Development Environment
-----------------------

If you want to patch or enhance this component, you will need to create a suitable development environment. The easiest way to do that is to install [phix4componentdev](http://phix-project.org):

    # phix4componentdev
    sudo apt-get install php5-xdebug
    sudo apt-get install php5-imagick
    sudo pear channel-discover pear.phix-project.org
    sudo pear -D auto_discover=1 install -Ba phix/phix4componentdev

You can then clone the git repository:

    # PHP-Component-Core-Enum
    git clone https://github.com/florianwolters/PHP-Component-Core-Enum

Then, install a local copy of this component's dependencies to complete the development environment:

    # build vendor/ folder
    phing build-vendor

To make life easier for you, common tasks (such as running unit tests, generating code review analytics, and creating the PEAR package) have been automated using [Phing](http://phing.info). You'll find the automated steps inside the `build.xml` file that ships with the component.

Run the command 'phing' in the component's top-level folder to see the full list of available automated tasks.

Comparison
----------

**This chapter is not finished yet!**

### Comparison matrix

**Disclaimer:** This matrix tries to compare existing enumeration type implentations for the PHP scripting language. It is neither complete nor can I guarantee that it is absolutely correct.

Name/Author              | type-safe? | Value Object? | Autocompletion? | Allows documentation of enum constants?         | Unit tests? | API documentation? | No errors/warnings?
------------------------ | ---------- | ------------- | --------------- | ----------------------------------------------- | ----------- | ------------------ | -------------------
[SplEnum][100]           | Yes        | ?             | Yes             | Yes (one class constant for each enum constant) | ?           | Yes                | ?
[Sean Hickey][101]       | Yes        | Yes           | Yes             | Yes (one class constant for each enum constant) | Yes         | Yes                | Yes
[Anthony Ferrara][102]   | Yes        | No            | Yes             | Yes (one class constant for each enum constant) | Yes         | Yes                | Yes
[Vlasta Neubauer][103]   | Yes        | Yes           | Yes             | Yes (one class constant for each enum constant) | No          | No                 | No
[zanshine][104]          | Yes        | Yes           | Yes             | Yes (generates one class for each enum type)    | Yes         | Yes                | ?
[bzikarsky][105]         | Yes        | Yes           | No              | - (one protected field for all enum constants)  | No          | Yes                | Yes
[jsjohnsr][106]          | Yes        | Yes           | No              | Yes (one subclass for each enum constant)       | No          | No                 | ?
[Jonathan Hohle][107]    | Yes        | Yes           | No              | No (one global function)                        | No          | Yes                | ?
[BiplaneEnumBundle][108] | ?          | ?             | ?               | ?                                               | ?           | Yes                | ?
[Fabian Schmengler][109] | ?          | ?             | ?               | ?                                               | ?           | ?                  | ?
[Oliver Anan][110]       | ?          | ?             | ?               | ?                                               | ?           | ?                  | ?
[Jim Sierra][111]        | ?          | ?             | ?               | ?                                               | ?           | ?                  | ?
[Ellery Leung][112]      | ?          | ?             | ?               | ?                                               | ?           | ?                  | ?
[Protato][113]           | ?          | ?             | ?               | ?                                               | ?           | ?                  | ?
[NogDog][114]            | ?          | ?             | ?               | ?                                               | ?           | ?                  | ?
[Christopher Fox][115]   | ?          | ?             | ?               | ?                                               | ?           | ?                  | ?
[aelg][116]              | ?          | ?             | ?               | ?                                               | ?           | ?                  | ?

### Own opinion

**Disclaimer:** This chapter reflects my personal (and therefore subjective) opinion. I don't write this down to hate, but to educate.

The implementations of [Sean Hickey][101], [Anthony Ferrara][102] and [Vlasta Neubauer][103] are userland implementations of the PECL extension [SplEnum][100].

These four implementations (including [SplEnum][100]) have one major drawback: They use class constants to represent the enumeration constants and the magic method [`__callStatic()`](http://php.net/language.oop5.overloading.php#object.callstatic) to retrieve the enumeration constant objects.
Therefore the identifier of the class constant is interpreted as the name of the enumeration constant and the value of the class constant is interpreted as the value of the enumeration constant.
This does not force the clients to use the enumeration constants as `Color::RED()`. A client can still use `COLOR::RED` which will always return a scalar (e.g. an integer) and not an object (the enumeration constant).
In addition, multiple enumeration constants can have the same value, which makes serialization unreliable.

The implementations differ in aspects of quality. For example, some have a documented API and unit tests while others are missing them.
Some allow other data types than integer as a value for an enumeration constant which is against the definition of an (C++) enumeration.

The implementation of [Jonathan Hohle][107] consists of one function that generates one abstract base class for each enumeration type and one concrete subclass for each enumeration constant of the enumeration type. In addition one class is generated that implements the `[\Iterator](http://php.net/class.iterator)` interface.
**Drawbacks:**

* The enumeration types can not be placed in a namespace.
* The function uses the "evil" eval() function. Enumeration constants such as `EMPTY` and `UNSET` cannot be created.
* Too much magic.
* The enumeration function is in the global namespace.

The implementation of [bzikarsky][105] uses one protected field (of data type array) to represent the enumeration constants.
**Drawbacks:**

* Too much magic.
* The enumeration class is in the global namespace.

[100]: http://php.net/class.splenum "SplEnum"
[101]: http://github.com/headzoo/php-enum "Sean Hickey"
[102]: http://github.com/ircmaxell/PHP-CryptLib/blob/master/lib/CryptLib/Core/Enum.php "Anthony Ferrara"
[103]: http://gist.github.com/1753178 "Vlasta Neubauer"
[104]: http://github.com/zanshine/php-enums "zanshine"
[105]: http://gist.github.com/638407 "bzikarsky"
[106]: http://github.com/jsjohnst/php_class_lib/tree/master/classes/types/enum "jsjohnsr"
[107]: http://it.toolbox.com/blogs/macsploitation/enums-in-php-a-native-implementation-25228 "Jonathan Hohle"
[108]: http://github.com/yethee/BiplaneEnumBundle "BiplaneEnumBundle"
[109]: http://phpclasses.org/package/6021-PHP-Implement-enumerated-values-as-class-functions.html "Fabian Schmengler"
[110]: http://phpclasses.org/package/6911-PHP-Create-enumerated-types-from-arrays-of-values.html "Oliver Anan"
[111]: http://phpclasses.org/package/4757-PHP-Provide-enumerated-data-type-with-constants.html "Jim Sierra"
[112]: http://phpclasses.org/package/4169-PHP-Implement-enumerated-types-using-arrays.html "Ellery Leung"
[113]: http://phpbuilder.com/board/showpost.php?s=52297b12ba0b12ad8e1c1da1247c187c&p=10885044&postcount=11 "Protato"
[114]: http://phpbuilder.com/board/showpost.php?s=52297b12ba0b12ad8e1c1da1247c187c&p=10901578&postcount=13 "NogDog"
[115]: http://stackoverflow.com/a/4522078 "Christopher Fox"
[116]: http://stackoverflow.com/a/4522078 "aelg"
License
-------

This program is free software: you can redistribute it and/or modify it under the terms of the GNU Lesser General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU Lesser General Public License for more details.

You should have received a copy of the GNU Lesser General Public License along with this program. If not, see http://gnu.org/licenses/lgpl.txt.
