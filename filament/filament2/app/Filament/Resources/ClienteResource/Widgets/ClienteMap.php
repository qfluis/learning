<?php

namespace App\Filament\Resources\ClienteResource\Widgets;

use Cheesegrits\FilamentGoogleMaps\Widgets\MapWidget;

use Filament\Actions\Action;
use Filament\Infolists\Components\Card;
use Filament\Infolists\Components\TextEntry;


class ClienteMap extends MapWidget
{
    protected static ?string $heading = 'Map';

    protected static ?int $sort = 1;

    protected static ?string $pollingInterval = null;

    protected static ?bool $clustering = true;

    protected static ?bool $fitToBounds = true;

    protected static ?int $zoom = 12;

    protected static ?string $markerAction = 'markerAction';

    protected function getData(): array
    {
    	/**
    	 * You can use whatever query you want here, as long as it produces a set of records with your
    	 * lat and lng fields in them.
    	 */
        $locations = \App\Models\Cliente::all();//->limit(500);

        $data = [];

        foreach ($locations as $location)
        {
			/**
			 * Each element in the returned data must be an array
			 * containing a 'location' array of 'lat' and 'lng',
			 * and a 'label' string (optional but reccomended by Google
			 * for accessibility.
			 */
            $data[] = [
                'location'  => [
                    'lat' => $location->latitud ? round(floatval($location->latitud), static::$precision) : 0,
                    'lng' => $location->longitud ? round(floatval($location->longitud), static::$precision) : 0,
                ],

                // 'label'     => $location->nombre,//$location->latitud . ',' . $location->longitud,
                'label' => view('widgets.map-label',['nombre' =>$location->nombre])->render(),
				/**
				 * Optionally you can provide custom icons for the map markers,
				 * either as scalable SVG's, or PNG, which doesn't support scaling.
				 * If you don't provide icons, the map will use the standard Google marker pin.
				 */
				'icon' => [
					'url' => url('images/map_icon.svg'),
					'type' => 'svg',
					'scale' => [35,35],
				],
            ];
        }

        return $data;
    }

    public function mountTableAction($livewire, $record) {
        // dd($this);
        return null;
    }

    public function markerAction(): Action
    // public function moutnTableAction()
	{
        dd('HOLIWI');
		return Action::make('markerAction')
			->label('Details')
			->infolist([
				Card::make([
					TextEntry::make('name'),
				])
				->columns(1)
			])
			->record(function (array $arguments) {
				return array_key_exists('model_id', $arguments) ? Location::find($arguments['model_id']) : null;
			})
			->modalSubmitAction(false);
	}

    public function getConfig(): array
    {
        $config = parent::getConfig();

        // Disable points of interest
        $config['mapConfig']['styles'] = [
            [
                'featureType' => 'poi',
                'elementType' => 'labels',
                'stylers' => [
                    ['visibility' => 'off'],
                ],
            ],
        ];

        return $config;
    }       
}