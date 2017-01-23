# dlpu-network

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Total Downloads][ico-downloads]][link-downloads]

dlpu-network 大连工业大学校园网自助服务

## Install

Via Composer

``` bash
$ composer require xu42/dlpu-network
```

## Usage

``` php
require_once './vendor/autoload.php';
$username = '1305040301';
$password = 'yourpassword';
$dlpuNetwork = new Xu42\DlpuNetwork\DlpuNetwork($username, $password);
$config = $dlpuNetwork->getConfig();	// IP 和 MAC 地址等配置信息
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

Tests unavailable.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please using the issue tracker.

## Credits

- [Xu42](https://github.com/xu42)
- [All Contributors](https://github.com/xu42/dlpu-network/contributors)

## License

The GPL2.0 License. Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/xu42/dlpu-network.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/xu42/dlpu-network.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/xu42/dlpu-network
[link-downloads]: https://packagist.org/packages/xu42/dlpu-network
[link-author]: https://github.com/xu42
[link-contributors]: ../../contributors
