<?php

namespace Shopex\Obs\Plugins;

use League\Flysystem\Plugin\AbstractPlugin;

class CreatePostSignature extends AbstractPlugin
{
    /**
     * createPostSignature.
     * @return string
     */
    public function getMethod(): string
    {
        return 'createPostSignature';
    }

    /**
     * @param array $args
     * @return mixed
     */
    public function handle(array $args = [])
    {
        return $this->filesystem->getAdapter()->createPostSignature($args);
    }
}