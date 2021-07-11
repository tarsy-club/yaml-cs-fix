<?php

namespace TarsyClub\YamlCsFix\YamlCsFixBundle\Command;

use Exception;
use TarsyClub\YamlCsFix\YamlCsFixBundle\Format\YamlFormat;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Finder\Finder;

class YamlFixCommand extends Command
{
    private const NAME_PATH = 'path';
    private const PATTERN = '/\.y(a)?ml$/';

    /**
     * @var YamlFormat|null
     */
    protected $yamlFormat;

    /**
     * @param YamlFormat|null $yamlFormat
     *
     * @return static
     */
    public function setFormat(?YamlFormat $yamlFormat = null)
    {
        $this->yamlFormat = $yamlFormat;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('tarsy-club:yaml-cs-fix')
            ->addOption(self::NAME_PATH, 'p', InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, 'Path')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        try {
            /**
             * @var string[] $dirs
             */
            $dirs = $input->getOption(self::NAME_PATH);
            $this->doExecute($io, $dirs);
        } catch (Exception $e) {
            $io->error($e->getMessage());
            $code = $e->getCode();
        }

        return $code ?? 0;
    }

    private function doExecute(SymfonyStyle $io, array $dirs): void
    {
        $report = $this->yamlFormat->format(
            (new Finder())
                ->name(static::PATTERN)
                ->files()
                ->in($dirs)
        );
        array_map(static function (string $file) use ($io): void {
            $io->warning($file . ' is invalid or empty');
        }, $report->getInvalidFiles());
        array_map(static function (string $file) use ($io): void {
            $io->success($file . ' successfully updated');
        }, $report->getFixedFiles());
        $io->table(['Errors', 'Updates'], [
            [count($report->getInvalidFiles()), count($report->getFixedFiles())],
        ]);
    }
}
