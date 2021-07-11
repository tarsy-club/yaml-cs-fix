<?php

namespace TarsyClub\YamlCsFix\YamlCsFixBundle;

use ReflectionClass;
use ReflectionException;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use TarsyClub\Framework\PrependExtension;

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
