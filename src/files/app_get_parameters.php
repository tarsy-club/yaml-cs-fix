<?php

namespace TarsyClub\YamlCsFix;

function app_get_parameters()
{
    return [
        \Symfony\Bundle\FrameworkBundle\FrameworkBundle::class => ['envs' => ['all' => true]],
        \Symfony\Bundle\MonologBundle\MonologBundle::class => ['envs' => ['all' => true]],
        \TarsyClub\YamlCsFix\YamlCsFixBundle\YamlCsFixBundle::class => ['envs' => ['all' => true]],
    ];
}
