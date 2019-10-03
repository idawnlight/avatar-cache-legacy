<?php
    /**
     * XPHP Configure File
     * 
     * You can add your providers here.
     * 
     */

    return function ($App) {

        $App->boot('\X\Middleware\Filter');
        $App->boot('\Avatar\Middleware\Handle');
        
    };