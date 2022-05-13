<?php

namespace Evotodi\IpFieldTypeBundle\DependencyInjection;


use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class EvotodiIpFieldTypeExtension extends Extension
{

    public function load(array $configs, ContainerBuilder $container)
    {
        $twigFormResources = $container->hasParameter('twig.form.resources')
            ? $container->getParameter('twig.form.resources')
            : array();

        $container->setParameter(
            'twig.form.resources',
            array_merge($twigFormResources, array('@EvotodiIpFieldType/Form/ipfield_widget.html.twig'))
        );

        $this->registerResources($container);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }

     /**
     * Registers the form resources for the Twig templating engines.
     *
     * @param ContainerBuilder $container The container.
     */
    protected function registerResources(ContainerBuilder $container)
    {
        $twigFormResources = $container->hasParameter('twig.form.resources')
            ? $container->getParameter('twig.form.resources')
            : array();

        $container->setParameter(
            'twig.form.resources',
            array_merge($twigFormResources, array('@EvotodiIpFieldType/Form/ipfield_widget.html.twig'))
        );

    }

    public function getAlias(): string
    {
        return 'evotodi_ip_field_type';
    }
}
