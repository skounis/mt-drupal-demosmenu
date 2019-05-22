# Drupal skeleton project based on Composer

> It is based on [drupal-composer/drupal-project
](https://github.com/drupal-composer/drupal-project)
> 
> A project template providing a starter kit for managing your site
dependencies with [Composer](https://getcomposer.org/).

If you want to know how to use it as replacement for
[Drush Make](https://github.com/drush-ops/drush/blob/8.x/docs/make.md) visit
the [Documentation on drupal.org](https://www.drupal.org/node/2471553).

## Usage

### Install dependencies
```
composer install
```
 
### List of available commands
```
./bin/robo
```

### Configuration

```
cp robo.yml.dist robo.yml
```

Update site settings
```
nano robo.yml
```

### Installation

```
./bin/robo project:install-config
```
or
```
./bin/robo pic -i
```


### Behat

Update paths for behat in robo.yml

```
nano robo.yml
```

Setup behat settings

```
./bin/robo project:setup-behat
```

Run behat tests

```
cd tests
./behat_no_proxy.sh behat
```
