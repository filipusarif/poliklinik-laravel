@extends('component.layout.app')
@push('title')
    <title>Poliklinik Udinus</title>
@endpush
@section('content')
    <section class="banner">
        @include('frontend.component.banner')
    </section>
    <section>
        @include('frontend.component.poli')
    </section>
    @include('frontend.component.footer')
@endsection