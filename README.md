Hiera implemented in PHP
======

## What is Hiera?
According to the [Hiera website](http://docs.puppetlabs.com/hiera/):

    Hiera is a key/value lookup tool for configuration data.
    
Hiera uses a configurable hierarchy to enable "Cascading Configuration".

It's great for infrastructure configuration (which is why it's used in Puppet),
but it also applies to multi-tenancy applications.

Hiera-PHP tries to be as much of a direct port as possible, maintaining
support for original configuration files, and even internal classnames and interfaces.

## Usage

hiera-php can be used both as a library, and as a console-tool

### Library

```php
use Hiera\Hiera;
use Hiera\Scope;
use Hiera\ConfigLoader\YamlConfigLoader;

$scope = new Scope();
$scope->setVariable('::environment', 'production');
$scope->setVariable('::clientcert', 'web01.dc1.example.webx');
$scope->setVariable('::country', 'nl');
$hiera = new Hiera();
$loader = new YamlConfigLoader();
$loader->load($hiera, $path_to_hiera_yaml_file);

$key = 'some_configuration_key';
$answer = $hiera->lookup($key, '#default#', $scope);
```


### Console tool

```
vendor/bin/hiera-php hiera:lookup some_configuration_key
```


## Features

* [x] Supports loading original `hiera.yaml` files
* [x] Supports pluggable backends
* [x] Yaml backend included (supporting original configuration yaml files)
* [x] Command line utility to perform lookups
* [x] Embeddable as a library
* [ ] Json backend
* [ ] Database (PDO, Redis, etc) backends
* [ ] Memcached backend
* [ ] Array merge strategies

Contributions are very welcome!

## License

MIT (see [LICENSE.md](LICENSE.md))

## Brought to you by the LinkORB Engineering team

<img src="http://www.linkorb.com/d/meta/tier1/images/linkorbengineering-logo.png" width="200px" /><br />
Check out our other projects at [linkorb.com/engineering](http://www.linkorb.com/engineering).

Btw, we're hiring!
