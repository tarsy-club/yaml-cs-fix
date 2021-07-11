<?php

namespace TarsyClub\YamlCsFix\YamlCsFixBundle\Format;

class Report
{
    /**
     * @var string[]
     */
    protected $fixedFiles = [];

    /**
     * @var string[]
     */
    protected $invalidFiles = [];

    /**
     * @return string[]
     */
    public function getFixedFiles(): array
    {
        return $this->fixedFiles;
    }

    /**
     * @param string $fixedFile
     *
     * @return static
     */
    public function addFixedFile(string $fixedFile)
    {
        $this->fixedFiles[] = $fixedFile;

        return $this;
    }

    /**
     * @return string[]
     */
    public function getInvalidFiles(): array
    {
        return $this->invalidFiles;
    }

    /**
     * @param string $invalidFile
     *
     * @return static
     */
    public function addInvalidFile(string $invalidFile)
    {
        $this->invalidFiles[] = $invalidFile;

        return $this;
    }
}
