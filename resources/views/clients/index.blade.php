@extends('layouts.app')

@section('content')
<div class="container">
    <clients-list :clients-from-the-view='@json($clients)'></clients-list>
</div>
@endsection
