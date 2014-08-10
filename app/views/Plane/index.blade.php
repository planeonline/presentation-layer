@extends('layout.default')

@section('content')
Planes!

<dl>

@foreach ($planes as $plane)

<dt>id : {{ $plane->id }}</dt>
    <dd>user : {{ $plane->user }}</dd>
    <dd>make : {{ $plane->make }}</dd>
    <dd>title : {{ $plane->title }}</dd>
    <dd>description : {{ $plane->description}}</dd>
    <dd>created : {{ $plane->created }}</dd>
    <dd>updated : {{ $plane->updated }}</dd>
    <dd>status : {{ $plane->status }}</dd>
@endforeach
</dl>

@stop