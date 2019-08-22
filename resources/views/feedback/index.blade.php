@extends('layouts.app')

@section('h1')
    Дареги
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/feedback.css') }}">
@endpush

@section('content')
    <div class="ownContent">
        <div class="content-header">
            <div class="row">
                <div class="col">
                    <h5>Дареги</h5>
                </div>
            </div>
        </div>
        <div class="row content_blc">
            <div class="col-md-4">
                {!! $entity['address'] !!}
            </div>
            <div class="col-md-8">
                <div class="image-wrapper">
                    <div class="contacts-full__map">
                        <div id="map"></div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div style="margin-top: 40px;">
                    {!! widget('address-page-content') !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        function initMap() {
            // The location of Uluru
            var uluru = {lat: <?=$entity['lat']?>, lng: <?=$entity['lng']?>};
            // The map, centered at Uluru
            var map = new google.maps.Map(
                document.getElementById('map'), {zoom: <?=$entity['zoom']?>, center: uluru});
            // The marker, positioned at Uluru
            var marker = new google.maps.Marker({position: uluru, map: map});
        }
    </script>

    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBmjHlOEzqUhPWgDTcgf5C9yFoKmkld66M&callback=initMap">
    </script>
@endpush