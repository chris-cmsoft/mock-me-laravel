{{ csrf_field() }}

<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label class="control-label">Name</label>
    <input type="text" name="name" value="{{ old('name', $route->name) }}" class="form-control">
    @foreach($errors->get('name') as $message)
        <span class="help-block">{{ $message }}</span>
    @endforeach
</div>

<div class="form-group {{ $errors->has('url') ? 'has-error' : '' }}">
    <label class="control-label">Url</label>
    <input type="text" name="url" value="{{ old('url', $route->url) }}" class="form-control">
    @foreach($errors->get('url') as $message)
        <span class="help-block">{{ $message }}</span>
    @endforeach
</div>

<button class="btn btn-default btn-block" type="submit">Submit</button>