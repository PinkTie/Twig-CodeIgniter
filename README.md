# Twig-CodeIgniter
[Twig](http://twig.sensiolabs.org/) template parser for [CodeIgniter](http://codeigniter.com) 3.xx+ (supports themes and HMVC)

## Installation

Place the Twig into the application/third_party folder or adjust the location in application/libraries/Twig.php

## Usage

Load the library

    $this->load->library('twig');
    
Output a view

    $this->twig->render('template', $data);

Change a theme

    $this->twig->setTheme('themename');
    

## Config

Configuration varibles are stored in application/config/twig.php
