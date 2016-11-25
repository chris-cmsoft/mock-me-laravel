{{ csrf_field() }}

<div class="form-group {{ $errors->has('request_method') ? 'has-error' : '' }}">
    <label class="control-label">Request Method</label>
    <select name="request_method" class="form-control">
        <option @if(old('request_method', $response->request_method) === 'get') selected @endif value="get">GET</option>
        <option @if(old('request_method', $response->request_method) === 'post') selected @endif value="post">POST</option>
        <option @if(old('request_method', $response->request_method) === 'put') selected @endif value="put">PUT</option>
        <option @if(old('request_method', $response->request_method) === 'patch') selected @endif value="patch">PATCH</option>
        <option @if(old('request_method', $response->request_method) === 'delete') selected @endif value="delete">DELETE</option>
        <option @if(old('request_method', $response->request_method) === 'options') selected @endif value="options">OPTIONS</option>
    </select>
    @foreach($errors->get('request_method') as $message)
        <span class="help-block">{{ $message }}</span>
    @endforeach
</div>

<div class="form-group {{ $errors->has('response_time') ? 'has-error' : '' }}">
    <label class="control-label">Response Time in Seconds</label>
    <input type="number" min="0" max="240" name="response_time" class="form-control" value="{{ old('response_time', $response->response_time) ?: 0 }}" />
    @foreach($errors->get('response_time') as $message)
        <span class="help-block">{{ $message }}</span>
    @endforeach
</div>

<div class="form-group {{ $errors->has('response_code') ? 'has-error' : '' }}">
    <label class="control-label">Response Code</label>
    <input type="number" name="response_code" class="form-control" value="{{ old('response_code', $response->response_code) ?: 200 }}" />
    @foreach($errors->get('response_code') as $message)
        <span class="help-block">{{ $message }}</span>
    @endforeach
</div>

<div class="form-group {{ $errors->has('payload') ? 'has-error' : '' }}">
    <label class="control-label">Payload</label>
    <textarea name="payload" class="form-control">{{ old('payload', $response->payload) }}</textarea>
    @foreach($errors->get('payload') as $message)
        <span class="help-block">{{ $message }}</span>
    @endforeach
</div>

<div class="form-group {{ $errors->has('is_active') ? 'has-error' : '' }}">
    <label class="control-label">Is Active</label>
    <select class="form-control" name="is_active">
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select>
    @foreach($errors->get('is_active') as $message)
        <span class="help-block">{{ $message }}</span>
    @endforeach
</div>

<input type="hidden" name="payload_type" value="json" />

<button type="submit" class="btn btn-block btn-default">Submit</button>