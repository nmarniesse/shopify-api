<?php

declare(strict_types=1);

namespace Nmarniesse\ShopifyApi;

use Shopify\Auth\FileSessionStorage;
use Shopify\Clients\HttpResponse;
use Shopify\Clients\Rest;
use Shopify\Context;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class FetchEvents extends Command
{
    protected static $defaultName = 'shopify:events:fetch';

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setDescription('Test.')
            ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        Context::initialize(
            $_ENV['SHOPIFY_API_KEY'],
            $_ENV['SHOPIFY_API_SECRET'],
            \explode(',', $_ENV['SHOPIFY_APP_SCOPES'] ?? ''),
            $_ENV['SHOPIFY_APP_HOST_NAME'],
            new FileSessionStorage('/tmp/php_sessions'),
            $_ENV['API_VERSION'],
            false,
            false,
        );

        $client = new Rest($_ENV['SHOPIFY_APP_HOST_NAME'], $_ENV['ACCESS_TOKEN']);
        $output->writeln($this->prettyfyResponse($client->get('events')));

        return Command::SUCCESS;
    }

    private function prettyfyResponse(HttpResponse $response): string
    {
        try {
            $decoded = \json_decode($response->getBody()->getContents(), true, JSON_THROW_ON_ERROR);

            return  \json_encode($decoded, JSON_PRETTY_PRINT);
        } catch (\JsonException $e) {
            return $response->getBody()->getContents();
        }
    }
}
