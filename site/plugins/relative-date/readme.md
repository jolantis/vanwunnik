![Relative Date for Kirby CMS](http://distantnative.com/remote/github/kirby-relativedate-github.png)  

[![Release](https://img.shields.io/github/release/distantnative/relative-date.svg)](https://github.com/distantnative/relative-date/releases)  [![Issues](https://img.shields.io/github/issues/distantnative/relative-date.svg)](https://github.com/distantnative/relative-date/issues) ![Kirby Version](https://img.shields.io/badge/Kirby-2.3%2B-red.svg)

Relative Date enables Kirby CMS to display date and time in a human-readable  format. It converts your absolute date (and time) in something relative and more readable. It is built on the [Carbon library](http://carbon.nesbot.com/) and offers access to all its methods.

#### Overview
1. [Requirements](#Requirements)
2. [Installation](#install)  
3. [Usage](#use)  
4. [Help & Improve](#helping)  
5. [Known Issues)](#issues)  
6. [Version History](#history)  


## Requirements <a id="Requirements"></a>
Kirby CMS 2.3.0+ and PHP 5.4+.


## Installation & Update <a id="Installation"></a>
1. [Download](https://github.com/distantnative/relative-date/archive/master.zip) the current release.
2. Add the files to `site/plugins/relative-date/` 

#### With the [Kirby CLI](https://github.com/getkirby/cli)
```
kirby plugin:install distantnative/relative-date
```

## Usage <a id="use"></a>
You can either use it as field method:
```php
<?= $page->published()->relativeDate() ?>
```

Or as [Kirbytext](http://getkirby.com/docs/content/text) tag:
```
Published: (relativeDate: 2015-02-15)
```

Or with the `relativeDate()` global helper function:
```
<?= relativeDate($page->modified()) ?>
```

## Use Carbon
Relative Date is a wrapper for a [Carbon](http://carbon.nesbot.com/) instance and only when echoed, shows the `diffForHumans()` method of Carbon. However, you can also use it for all other methods of Carbon, e.g.:

```
<?php
$relativeDate = relativeDate($page->modified());

echo $relativeDate->addDays(5)->diffForHumans(); 
echo $relativeDate->isBirthday()
…

?>
```


## Help & Improve <a id="Help"></a>
*If you have any suggestions for further configuration options, [please let me know](https://github.com/distantnative/relative-date/issues/new).*


## Known Issues <a id="issues"></a>
- This plugin cannot be used with the Kirby's default date field as it is not chainable. Please use the plugin on a field named differently than `date`, e.g. `published`. As another workaround the `date` field could be passed directly to the `relativeDate()` helper function:
```php
<?= relativeDate($page->date('Y-m-d')) ?>
``` 


## Version history <a id="VersionHistory"></a>
You can find a more or less complete version history in the [changelog](CHANGELOG.md).

## License
[MIT License](http://www.opensource.org/licenses/mit-license.php)

## Author
Nico Hoffmann - <https://nhoffmann.com>
