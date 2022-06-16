<?php

declare(strict_types=1);

namespace Nmarniesse\ShopifyApi;

use Shopify\Auth\FileSessionStorage;
use Shopify\Context;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class Test extends Command
{
    protected static $defaultName = 'shopify:test';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        Context::initialize(
            $_ENV['SHOPIFY_API_KEY'],
            $_ENV['SHOPIFY_API_SECRET'],
            $_ENV['SHOPIFY_APP_SCOPES'],
            $_ENV['SHOPIFY_APP_HOST_NAME'],
            new FileSessionStorage('/tmp/php_sessions'),
            '2021-04',
            true,
            false,
        );

        return 0;
    }
}
