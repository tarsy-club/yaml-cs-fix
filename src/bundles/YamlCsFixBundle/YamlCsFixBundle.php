<?php

namespace TarsyClub\YamlCsFix\YamlCsFixBundle;

use TarsyClub\Framework\PrependExtension;
use ReflectionClass;
use ReflectionException;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class YamlCsFixBundle extends Bundle
{
    private const ALIAS = 'tarsy-club-yaml-cs-fix';

    /**
     * {@inheritdoc}
     *
     * @throws ReflectionException
     */
    public function getContainerExtension()
    {
        return new PrependExtension(
            (new ReflectionClass($this))->getShortName(),
            self::ALIAS
        );
    }
}
