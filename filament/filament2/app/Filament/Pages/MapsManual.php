<?php

namespace App\Filament\Pages;

use App\Models\Cliente;
use Filament\Pages\Page;

class MapsManual extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.maps-manual';

    public $pins = [];

    public function mount() {
        $this->pins = Cliente::all();
        // foreach ($clientes as $cliente) {
        //     $this->pins[] = [
        //         'lat' => $cliente->latitude,
        //         'lng' => $cliente->longitude,
        //         'title' => $cliente->nome,
        //         'description' => $cliente->endereco,
        //     ];
        // }
    }



}
