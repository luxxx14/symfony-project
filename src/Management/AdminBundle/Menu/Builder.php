<?php

namespace Management\AdminBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root', ['childrenAttributes' => ['class' => 'sidebar-menu']]);

        $menu->addChild('Статичные блоки', ['attributes' => ['class' => 'header']]);
        $menu->addChild('Общая информация', ['route' => 'admin_common_information_index']);
        $menu->addChild('Компоненты платформы', ['route' => 'admin_component_index']);
        $menu->addChild('Основные преимущества', ['route' => 'admin_advantage_index']);
        $menu->addChild('Кто использует', ['route' => 'admin_client_index']);
        $menu->addChild('О компании', ['route' => 'admin_company_information_index']);

        $menu->addChild('Maven', ['attributes' => ['class' => 'header']]);
        $menu->addChild('Коды для Maven', ['route' => 'admin_version_index']);

        $menu->addChild('Новости', ['attributes' => ['class' => 'header']]);
        $menu->addChild('Настройка источника RSS', ['route' => 'admin_feed_source_index']);
        $menu->addChild('Модерация новостей', [
            'route' => 'admin_redirect_for_selected_feed_source',
            'routeParameters' => ['action' => 'show_feed']
        ]);

        $menu->addChild('Подписчики', ['attributes' => ['class' => 'header']]);
        $menu->addChild('Список подписчиков', ['route' => 'admin_subscriber_index']);

        return $menu;
    }
}
