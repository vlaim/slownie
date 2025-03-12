# Słownie

[![Latest Version on Packagist](https://img.shields.io/packagist/v/vlaim/slownie.svg?style=flat-square)](https://packagist.org/packages/swiatprzesylek/gl/)
![PHP UNIT](https://github.com/vlaim/slownie/actions/workflows/php.yml/badge.svg)

🇵🇱 **Słownie** to biblioteka PHP umożliwiająca zamianę liczb na zapis słowny w języku polskim.

🇬🇧 **Słownie** is a PHP library that converts numbers into words in Polish.

## 📦 Installation

### Using Composer

Install this package via [Composer](https://getcomposer.org/):

```json
{
    "require": {
        "vlaim/slownie": "^1"
    }
}
```

Run:

```sh
composer require vlaim/slownie
```

## 🚀 Basic Usage

The main method to convert numbers to words:

```php
Slownie::convert($number, bool $hideGrosze = false, bool $hideZlote = false)
```

### Parameters:
- **$number** *(int | float | string)* – The number to convert.
- **$hideGrosze** *(bool, default: false)* – If `true`, omits grosze (00/100).
- **$hideZlote** *(bool, default: false)* – If `true`, omits "złoty/złotych/złote".

### Examples:

Convert a number to words:
```php
Slownie::convert(10348);
// Output: "dziesięć tysięcy trzysta czterdzieści osiem złotych 00/100"
```

Hide grosze:
```php
Slownie::convert(10348, true);
// Output: "dziesięć tysięcy trzysta czterdzieści osiem złotych"
```

Hide "złoty/złotych/złote":
```php
Slownie::convert(10348, true, true);
// Output: "dziesięć tysięcy trzysta czterdzieści osiem"
```

## 🧪 Running Tests

To run tests, use:

```sh
composer test
```

## 🛠 Issues & Support

For bug reports and feature requests, visit the [GitHub Issue Tracker](https://github.com/vlaim/slownie/issues).

Feel free to open an issue if you have any questions.

## 📜 License

**vlaim/slownie** is released under the [MIT License](LICENSE.md).

