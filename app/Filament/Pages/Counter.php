<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Counter extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.counter';
}
