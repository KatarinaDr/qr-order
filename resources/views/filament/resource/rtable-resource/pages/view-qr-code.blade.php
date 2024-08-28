<x-filament::page>
    Table number: {{$record->number}}
    <div style="display: flex; align-items: center; justify-content: center;">
        {!! QrCode::size(200)->generate(implode(['link' => $record->number, 'number' => $record->web_page])) !!}
    </div>
    
</x-filament::page>
