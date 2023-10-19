<?php

namespace App\Infolists\Components;

use Filament\Infolists\Components\Component;

class TopSection extends Component
{
    protected string $view = 'infolists.components.top-section';

    public static function make(): static
    {
        return app(static::class);
    }
}
