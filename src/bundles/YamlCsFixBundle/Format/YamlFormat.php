<?php

namespace TarsyClub\YamlCsFix\YamlCsFixBundle\Format;

use SplFileInfo;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;

class YamlFormat
{
    private const INDENT_SIZE = 4;
    private const INLINE_LEVEL = 16; // do not use new line chars

    public function format(Finder $files): Report
    {
        $report = new Report();
        /** @var SplFileInfo $file */
        foreach ($files as $file) {
            try {
                $content = $this->parse($file);
                if (null === $content) {
                    $report->addInvalidFile($file);
                    continue;
                }
                $hash = md5(serialize($content));
                $content = $this->sort($content);
                if (md5(serialize($content)) !== $hash) {
                    $report->addFixedFile($file);
                    file_put_contents($file->getRealPath(), $this->dump($content));
                }
            } catch (ParseException $exception) {
                $report->addInvalidFile($file);
            }
        }

        return $report;
    }

    /**
     * @param $content
     *
     * @return string
     */
    protected function dump($content): string
    {
        return Yaml::dump(
            $content,
            static::INLINE_LEVEL,
            static::INDENT_SIZE,
            Yaml::DUMP_OBJECT
        );
    }

    /**
     * @param SplFileInfo $file
     *
     * @throws ParseException
     *
     * @return array|null
     */
    protected function parse(SplFileInfo $file): ?array
    {
        return Yaml::parseFile($file->getRealPath());
    }

    private function sort(array $values)
    {
        return (new class() {
            private function _sort(array &$values): void
            {
                ksort($values);
                foreach (array_keys($values) as $key) {
                    if (is_array($values[$key])) {
                        $this->{__FUNCTION__}($values[$key]);
                    }
                }
            }

            public function __invoke(array $values)
            {
                $result = $values;
                $this->_sort($result);

                return $result;
            }
        })($values);
    }
}
