{{ csrf_field() }}

<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label class="control-label">
        Api Name
    </label>
    <input type="text" name="name" maxlength="255" class="form-control" value="{{ old('name',$api->name) }}" />
    @forelse($errors->get('name') as $message)
        <span class="help-block">{{$message}}</span>
    @empty
        <span class="help-bock">How Would you like to identify this API on Mock Me</span>
    @endforelse
</div>

<button class="btn btn-default btn-block">Submit</button>
