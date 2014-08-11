Uptime - PHP
==================

[![Build Status](https://travis-ci.org/marcioAlmada/uptime.svg?branch=master)](https://travis-ci.org/marcioAlmada/uptime)
[![Coverage Status](https://coveralls.io/repos/marcioAlmada/uptime/badge.png)](https://coveralls.io/r/marcioAlmada/uptime)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/marcioAlmada/uptime/badges/quality-score.png?s=37693c66e5b73c0a5e1480e001cbd09d05b767b7)](https://scrutinizer-ci.com/g/marcioAlmada/uptime/)
[![Latest Stable Version](https://poser.pugx.org/uptime/uptime/v/stable.png)](https://packagist.org/packages/uptime/uptime)
[![Total Downloads](https://poser.pugx.org/uptime/uptime/downloads.png)](https://packagist.org/packages/uptime/uptime)
[![License](https://poser.pugx.org/uptime/uptime/license.png)](https://packagist.org/packages/uptime/uptime)

The missing PHP uptime package inspired by python module [uptime](https://pythonhosted.org/uptime/#module-uptime).

> This package aims to provides a **cross platform** PHP API — OO and functional — that tells you how long your system has been up and when it booted. This turns out to be surprisingly non-straightforward across systems, but not impossible on any major platform.

## Supported Platforms

|     | Group   | Systems |
|:---:|:---     |:---|
| :ok:| BSD     | `FreeBSD`, `OpenBSD`, `NetBSD`, `BSD`
| :ok:| Linux   | `Linux`, `Cygwin`, `Linux-armv71`, `Linux2`, `Unix`, `SunOS`
| :ok:| Darwin  | `Darwin`, `Mac`, `OSX`
| :ok:| Windows | `Windows`, `Win32`, `Winnt`
| :ok:| OpenVMS | `OpenVMS`
| :octocat: | NetWare | `?`

## Composer Installation

```json
{
  "require": {
    "uptime/uptime": "~0.1"
  }
}
```

Through terminal: `composer require uptime/uptime:~0.1` :8ball:

## Quick Guide

Besides classes, this package registers two global functions: `uptime` and `boottime`.

```php
$seconds   = uptime();   # <float> uptime in seconds
$timestamp = boottime(); # <string> server boottime timestamp
```
For more complex manipulations you can use the OO interface:

```php
use Uptime\System;

$system = new System();           # <Uptime\System #>

$uptime = $system->getUptime();   # <Uptime\Uptime implements \DateInterval #> {}

$uptime->d                        # <int> days
$uptime->h                        # <int> hours
$uptime->m                        # <int> minutes
$uptime->s                        # <float||int> seconds

$bootime = $system->getBootime(); # <Uptime\Bootime implements \DateTime #> {}
$bootime->format('Ymd H:i:s');    # <string> formatted date

echo 'Uptime: ' . $uptime . '. Boottime: ' . $bootime; # yes we have __toString
```

Uptime will guess your current OS by parsing [`PHP_OS`](http://www.php.net/manual/en/reserved.constants.php)
constant value. In case you're using any exotic platform that is known to be compatible with one of
the supported [systems](#supported-platforms), you can bypass OS detection by informing
your system identifier manually (case insensitive):

```php
$seconds   = uptime('JunOS');   # <float||int> server uptime in seconds
$timestamp = boottime('JunOS'); # <string> server boottime timestamp
```
You can bypass automatic system detection using the `Uptime\System` class too:

```php
use Uptime\System;

$system = new System('JunOS'); # <Uptime\System #>
$system = new System('Amiga'); # throws <Uptime\UnsuportedSystemException #> {}
                               # patches welcome ;)
```

### Notes

- Returned values will be as precise as your platform allows to, usually microseconds but it can be seconds;
- Some platforms need a better way to get uptime and boottime;
- For some platforms [`shell_exec`](http://www.php.net/manual/en/function.shell-exec.php) function needs to be enabled;

## Extending Platform Support

0. Check `PHP_OS` constant value;
0. Map your platform or system identifier on [`Uptime\System\SystemTable::$map`](/src/System/SystemTable.php#L16);
0. Create a new runtime under `src/Runtime/<NewSystemGroup>/*`, if necessary;
0. Add new tests to `test/Runtime/<NewSystemGroup>/*`, if necessary;
0. Pull request;

## Features & Roadmap

- [x] Functional API
- [x] OO API
- [ ] Add a facade
- [ ] Write guide and manual
- [ ] Better cross platform tests
- [ ] Try to avoid child processes
- [ ] Maybe C extension

## Copyright

Copyright (c) 2014 Márcio Almada. Distributed under the terms of an MIT-style license.
See LICENSE for details.