# tarsy-club yaml-cs-fix #

console command to fix yaml structure in files

## example ##

```bash
composer console tarsy-club:yaml-cs-fix --\
  -p resources
```

## build phar ##

### compile ###

* create .env, see [example](resources/dist/.env.env-dist) or use these env vars at runtime `APP_ENV=local ... tarsy-club-yaml-cs-fix ...`
* run `composer run box:compile`

`APP_DEBUG=0` is required for proper box compile 

### Usage ###

#### Using as a composer package ####

1. `composer req tarsy-club/yaml-cs-fix`
1. `\TarsyClub\YamlCsFix\YamlCsFixBundle\YamlCsFixBundle::class => ['envs' => ['local' => true]],` in the app_get_parameters
1. `composer console tarsy-club:yaml-cs-fix ... `

or as a composer vendored script

`composer exec tarsy-club-yaml-cs-fix tarsy-club:yaml-cs-fix ...`

or as shell command

`vendor/tarsy-club/yaml-cs-fix/tarsy-club-yaml-cs-fix tarsy-club:yaml-cs-fix ...`

##### alternative dowload #####

```bash
git archive --remote=git@github.com:tarsy-club/yaml-cs-fix.git HEAD tarsy-club-yaml-cs-fix|tar -x > tarsy-club-yaml-cs-fix
```