<?php

declare(strict_types=1);

namespace Elementareteilchen\ClearCacheByTag\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use TYPO3\CMS\Core\Cache\CacheManager;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class ClearByTag extends Command
{
    protected function configure(): void
    {
        $this
            ->setDescription('Clear TYPO3 caches by cache tag')
            ->addArgument(
                'tag',
                InputArgument::REQUIRED,
                'Comma separated list of tags to clear cache for'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $cacheTagsToClear = array_unique(GeneralUtility::trimExplode(',', $input->getArgument('tag'), true));

        if (count($cacheTagsToClear) > 0) {
            $cacheManager = GeneralUtility::makeInstance(CacheManager::class);
            $cacheManager->flushCachesByTags($cacheTagsToClear);
            $output->writeln(
                'Cache for cache tags were flushed. Cache tags provided: '
                . implode(', ', $cacheTagsToClear)
            );
        } else {
            $output->writeln('There were no cache tags for flushing provided');
            return Command::INVALID;
        }

        return Command::SUCCESS;
    }
}
