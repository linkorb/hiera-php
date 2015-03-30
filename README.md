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
