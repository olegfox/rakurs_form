<?php

namespace Site\MainBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class BackendMenuBuilder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $menu->setCurrent($this->container->get('request')->getRequestUri());

        $menu->addChild('Настройки', array('route' => 'backend_settings_index'));
        $menu->addChild('Страницы', array('route' => 'backend_page_index'));
        $menu->addChild('Отели', array('route' => 'backend_hotel_index'));
        $menu->addChild('Классы номеров', array('route' => 'backend_class_room_index'));
        $menu->addChild('Вокзалы', array('route' => 'backend_stations_index'));

        return $menu;
    }

    public function userMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $menu->addChild('Выход', array('route' => 'fos_user_security_logout'));

        $menu->setCurrent($this->container->get('request')->getRequestUri());

        return $menu;
    }
}