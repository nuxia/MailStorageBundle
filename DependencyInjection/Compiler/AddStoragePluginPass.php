<?php

namespace Nuxia\MailStorageBundle\DependencyInjection\CompilerPass;

use Nuxia\MailStorageBundle\Storage\StoragePlugin;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Validator\Tests\Fixtures\Reference;

/**
 * @author Johann Saunier <johann_27@hotmail.fr>
 */
class AddStoragePluginPass implements CompilerPassInterface
{
    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        /** @var \Swift_Mailer $mailer */
        $mailer = $container->getDefinition('mailer');
        $mailer->registerPlugin(new StoragePlugin(new Reference('nuxia.mail_storage.mail_entry.manager')));
    }
}
