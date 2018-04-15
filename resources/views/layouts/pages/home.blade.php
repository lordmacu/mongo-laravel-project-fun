@extends('layouts.main')

@section("content")

<div class="row">
    <div class="col-md-7">
        <div class="row container-places">
           
        </div>
        
    </div>
    <div class="col-md-5 map-container">
        @include("layouts.pages.map")
    </div>
</div>
@stop

