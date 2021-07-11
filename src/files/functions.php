<?php

namespace TarsyClub\YamlCsFix;

function get_safe_dir(string $dir): string
{
    return ($pharFilename = \Phar::running()) ? ($pharFilename . '/') : $dir;
}
