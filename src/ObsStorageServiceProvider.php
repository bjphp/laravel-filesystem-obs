<?php

namespace Shopex\Obs;

use Illuminate\Support\ServiceProvider;
use League\Flysystem\Filesystem;
use Obs\ObsClient;
use Shopex\Obs\Plugins\CreatePostSignature;

class ObsStorageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        app('filesystem')->extend('obs', function ($app, $config) {
            $debug = $config['debug'] ?? false;
            $endpoint = $config['endpoint'] ?? '';
            $cdn_domain = $config['cdn_domain'] ?? '';
            $ssl_verify = $config['ssl_verify'] ?? false;

            if ($debug) {
                app('log')->debug('OBS config => '. var_export($config, 1));
            }

            $client = new ObsClient($config);

            $bucket = $config['bucket'] ?? '';

            $filesystem = new Filesystem(new ObsAdapter($client, $bucket, $endpoint, $cdn_domain, $ssl_verify));

            $filesystem->addPlugin(new CreatePostSignature());

            return $filesystem;
        });
    }

    /**
     * Register any application services.
     */
    public function register()
    {
    }
}