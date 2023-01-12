@extends('layouts.layout')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="text-center my-5">
            <h2>Poszt módosítása</h2>
        </div>
        <div class="col-12 col-md-8 col-xl-6 col-xxl-4 border rounded p-5">
            <x-alert />
            <x-forms.edit-post-form :post="$post"/>
        </div>
    </div>
</div>    
@endsection