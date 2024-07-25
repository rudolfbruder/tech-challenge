@extends('layouts.app')

@section('content')
<div class="container-fluid">
    Content:
    <p>{{$journal->content}}</p>
    <small>Written at:{{$journal->written_at}}</small>
</div>
@endsection
