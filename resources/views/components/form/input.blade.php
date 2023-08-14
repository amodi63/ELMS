@props([
    'type'=> 'text',
    'name',
    'id' => "",
    'value' => ''
    ])
    
    <input type="{{ $type}}" name="{{ $name }}" id="{{ $id }}" value ="{{ $value }}" @checked($value == 'active') {{ $attributes }} class="form-control">

