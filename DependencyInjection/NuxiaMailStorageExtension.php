<?php

namespace Nuxia\MailStorageBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class NuxiaMailStorageExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config/services'));
        $this->loadDoctrine($config, $container, $loader);
        $loader->load('mail_entry.yml');
        $this->loadStorage($config, $container, $loader);
    }

    /**
     * @param array            $config
     * @param ContainerBuilder $container
     * @param YamlFileLoader   $loader
     */
    private function loadDoctrine(array $config, ContainerBuilder $container, YamlFileLoader $loader)
    {
        $loader->load('orm.yml');
        $loader->load('doctrine.yml');
    }

    /**
     * @param array            $config
     * @param ContainerBuilder $container
     * @param YamlFileLoader   $loader
     */
    private function loadStorage(array $config, ContainerBuilder $container, YamlFileLoader $loader)
    {
        $loader->load('storage.yml');
        $mailers = $container->getParameter('swiftmailer.mailers');
        foreach ($mailers as $name => $mailer) {
            $container->getDefinition('nuxia.mail_storage.storage.swiftmailer_plugin')->addTag(sprintf('swiftmailer.%s.plugin', $name));
        }
    }
}
