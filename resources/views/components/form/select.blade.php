
@props(['options', 'name', 'selected' => null , 'id'=> ''])
<div class="dropdown" >

    <select class="form-control selectpicker" name="{{ $name }}" id="{{ $name }}" {{ $attributes}}>
        <option value="">Select</option>
        @foreach($options as $value => $label)
            <option value="{{ $value }}" @selected( $selected == $value) >{{ $label }}</option>
        @endforeach
    </select>
</div>