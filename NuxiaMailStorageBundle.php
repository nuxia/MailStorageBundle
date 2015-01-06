<?php

namespace Nuxia\MailStorageBundle;

use Nuxia\MailStorageBundle\DependencyInjection\CompilerPass\AddStoragePlugin;
use Nuxia\MailStorageBundle\DependencyInjection\CompilerPass\AddStoragePluginPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class NuxiaMailStorageBundle extends Bundle
{
    /**
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new AddStoragePluginPass());
        parent::build($container);
    }
}
