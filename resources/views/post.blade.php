@foreach ($posts as $item)
    <h1>{{$item->title}}</h1><br>
    <p>{{ $item->description }}</p>
@endforeach
