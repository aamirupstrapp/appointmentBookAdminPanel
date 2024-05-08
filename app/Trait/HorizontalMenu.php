<?php

namespace App\Trait;

trait HorizontalMenu
{
    protected function staticMenu($menu, $data)
    {
        $menu->add('
                <span class="default-icon">'.$data['title'] ?? '-'.'</span>
                <span class="mini-icon">-</span>
            ', [
            'url' => '#',
            'class' => 'nav-item static-item',
        ])
            ->data(['order' => $data['order'] ?? 0])
            ->link->attr([
                'class' => 'nav-link static-item disabled',
            ]);
    }

    protected function mainRoute($menu, $data)
    {
        $menuData = [];

        if (isset($data['route'])) {
            $menuData['route'] = $data['route'];
        } elseif (isset($data['url'])) {
            $menuData['url'] = $data['url'] ?? '#';
        } else {
            $menuData['route'] = 'login';
        }

        $linkData = ['class' => 'nav-link'];

        if (isset($data['target']) && $data['target']) {
            $linkData['target'] = $data['target'];
        }

        $menuData['class'] = 'nav-item';

        $menu->add($this->createMenuTitle($data['title'] ?? ''), $menuData)
            ->data([
                'order' => $data['order'] ?? 0,
                'activematches' => $data['active'] ?? '',
                'permission' => $data['permission'] ?? [],
            ])
            ->prepend($this->createMenuIcon($data['icon'] ?? ''))
            ->append($this->createMenuIcon($data['sub_icon'] ?? ''))
            ->link->attr($linkData);
    }

    protected function parentMenu($menu, $data)
    {
        $sub_menu = $menu->add($this->createMenuTitle($data['title'] ?? ''), ['class' => $data['li_class'] ?? 'nav-item'])
            ->nickname($data['nickname'])
            ->data([
                'order' => $data['order'] ?? 0,
                'activematches' => $data['active'] ?? '',
                'permission' => $data['permission'] ?? [],
            ])
            ->prepend($this->createMenuIcon($data['icon'] ?? null));

        $sub_menu->link->attr([
            'class' => $data['a_class'] ?? 'nav-link',
            'href' => '#'.$data['nickname'] ?? 'sidemenu',
            'data-bs-parent' => $data['parent'] ?? '#sidebar-menu',
        ]);
        $sub_menu->url('#'.$data['nickname'] ?? 'sidemenu');

        return $sub_menu;
    }

    protected function childMain($menu, $data)
    {
        $menu->add($this->createMenuTitle($data['title']), [
            'route' => $data['route'],
            'class' => $data['li_class'] ?? 'nav-item',
        ])
            ->data([
                'order' => $data['order'] ?? 0,
                'activematches' => $data['active'] ?? '',
                'permission' => $data['permission'] ?? [],
            ])
            ->prepend($this->createMenuIcon($data['icon'] ?? null))
            ->link->attr(['class' => $data['a_class'] ?? 'nav-link']);
    }

    protected function popupMenu($menu, $data)
    {
        $menu->add($this->createMenuTitle($data['title']), [
            'url' => 'javascript:void(0)',
            'class' => 'nav-item',
            'data-bs-toggle' => $data['extra']['toggle'],
            'data-bs-target' => $data['extra']['target'],
        ])
            ->data([
                'order' => $data['order'] ?? 0,
                'activematches' => $data['active'] ?? '',
                'permission' => $data['permission'] ?? [],
            ])
            ->link->attr(['class' => 'nav-link']);
    }

    protected function createMenuTitle($title)
    {
        return "<span class='nav-text ms-2'>$title</span>";
    }

    protected function createMenuIcon($cutomeIcon = null)
    {
        $icon = '';

        if (isset($cutomeIcon)) {
            $icon = $cutomeIcon;
        }

        return $icon;
    }

    public function createCompanyMenu($menu)
    {
        $huimenu = \Menu::get('horizontal_menu');
        // if (\Menu::exists('horizontal_menu') && isset($huimenu)) {

        //     $company = \Menu::get('horizontal_menu')->company;
        // } else {
        //     // Company
        //     $company = $this->parentMenu($menu, [
        //         'icon' => '<svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M21.9964 8.37513H17.7618C15.7911 8.37859 14.1947 9.93514 14.1911 11.8566C14.1884 13.7823 15.7867 15.3458 17.7618 15.3484H22V15.6543C22 19.0136 19.9636 21 16.5173 21H7.48356C4.03644 21 2 19.0136 2 15.6543V8.33786C2 4.97862 4.03644 3 7.48356 3H16.5138C19.96 3 21.9964 4.97862 21.9964 8.33786V8.37513ZM6.73956 8.36733H12.3796H12.3831H12.3902C12.8124 8.36559 13.1538 8.03019 13.152 7.61765C13.1502 7.20598 12.8053 6.87318 12.3831 6.87491H6.73956C6.32 6.87664 5.97956 7.20858 5.97778 7.61852C5.976 8.03019 6.31733 8.36559 6.73956 8.36733Z" fill="currentColor"></path><path opacity="0.4" d="M16.0374 12.2966C16.2465 13.2478 17.0805 13.917 18.0326 13.8996H21.2825C21.6787 13.8996 22 13.5715 22 13.166V10.6344C21.9991 10.2297 21.6787 9.90077 21.2825 9.8999H17.9561C16.8731 9.90338 15.9983 10.8024 16 11.9102C16 12.0398 16.0128 12.1695 16.0374 12.2966Z" fill="currentColor"></path><circle cx="18" cy="11.8999" r="1" fill="currentColor"></circle></svg>',
        //         'title' => 'COMPANY',
        //         'nickname' => 'company',
        //         'order' => 200,
        //     ]);
        // }

        // return $company;
    }
}
