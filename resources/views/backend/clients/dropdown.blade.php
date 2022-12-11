@foreach($clients as $client)
    <option mobile="{{$client->mobile}}" address="{{$client->address}}" value="{{ $client->id }}">{{ $client->name }}</option>
@endforeach
