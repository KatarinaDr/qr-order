<x-filament::page>
    Table number: {{$record->number}}
    <div style="display: flex; align-items: center; justify-content: center;">
        {!! QrCode::size(200)->generate(implode(['link' => $record->web_page, 'number' => $record->number])) !!}
    </div>
    
</x-filament::page>
