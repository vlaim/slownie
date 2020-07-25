# Słownie

[![Build Status](https://travis-ci.com/vlaim/slownie.svg?token=yjpboQ1s7oorxyxVXyou&branch=master)](https://travis-ci.com/vlaim/slownie)
[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)

🇵🇱 Ta biblioteka pomaga zapisać liczby w postaci słownej.


This library helps you to write numbers into words in Polish.


## Installation

## Basic usage 

```
Slownie::convert(10348) // dziesięć tysięcy trzysta czterdzieści osiem złotych
```

To hide 'złoty' / 'złotych' / 'złote' pass `false` to the second param

```
Slownie::convert(10348, false) //  dziesięć tysięcy trzysta czterdzieści osiem
```

## Tests

To run tests: 
```
composer test
```

## Issues

Bug reports and feature requests can be submitted on the [Github Issue Tracker](https://github.com/vlaim/slownie/issues). 

Feel free to open an issue on every question you have.


## License

**vlaim/slownie** is released under the MIT License. See the bundled LICENSE.md for details.

[ico-version]: https://img.shields.io/packagist/v//vlaim/slownie.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/vlaim/slownie


