<?php

namespace App\Controllers;

class About extends BaseController
{
    public function index(): string
    {
        return $this->renderPage('about/index', [
            'title'      => 'About EverTask',
            'developer'  => 'Tristan Josh Cachapero',
            'section'    => 'TW32',
            'course'     => 'IT0049 · Web System Technologies',
            'professor'  => 'Sir. Von Magbitang',
            'activePage' => 'about',
        ]);
    }
}
