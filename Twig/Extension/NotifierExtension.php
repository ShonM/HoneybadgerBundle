<?php

namespace Chesscom\HoneybadgerBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\ContainerInterface;

class NotifierExtension extends \Twig_Extension
{
    protected $options = array();

    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getFunctions()
    {
        return array(
            'honeybadger_notifier' => new \Twig_Function_Method($this, 'getHoneybadgerNotifier', array(
                'is_safe' => array('html'),
            ))
        );
    }

    public function getHoneybadgerNotifier()
    {
        return $this->container->get('templating')->render('EoHoneybadgerBundle:Extension:notifier.html.twig', array(
            'client_key' => $this->container->getParameter('chesscom_honeybadger.client_key'),
        ));
    }

    public function getName()
    {
        return 'honeybadger_notifier_extension';
    }
}
