<?php

namespace App\Cells;

use CodeIgniter\View\Cells\Cell;

class BottomNavbar extends Cell
{
    protected $links = [
        [
            'url'     => 'map',
            'icon'     => 'bi-map-fill',
            'isActive' => false,
        ],
        [
            'url'     => 'capture',
            'icon'     => 'bi-camera',
            'isActive' => false,
        ],
        [
            'url'     => 'profile',
            'icon'     => 'bi-person-fill',
            'isActive' => false,
        ],
    ];

    public function mount()
    {
        $uri = service('uri');
        $segments = $uri->getSegments();
        foreach ($this->links as $key => $link) {
            foreach ($segments as $segment) {
                if ($link['url'] == $segment) 
                    $this->links[$key]['isActive'] = true;
            }
        }
        $this->links[2]['url'] = 'profile/' . session()->get('id');
    }

    public function render(): string
    {
        $data = ['links' => $this->links];
        return $this->view('bottom_navbar', $data);
    }
}
