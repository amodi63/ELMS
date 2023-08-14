@props(['options', 'name', 'checked'=>'active', 'id'=> ''])
@foreach ($options as $key => $option )
<label  {{ $attributes->class(['radio']) }}>
    <input type="radio" name="{{ $name }}" value="{{ $key }}" @checked($key == $checked)>
    <span></span>{{ $option }}
</label>
@endforeach
