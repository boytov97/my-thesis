@if(count($slider) > 0)
    <div class="slideshow-container">
        @php $i = 1; @endphp
        @foreach($slider as $slide)
            <div class="mySlides fadeOwn">
                <div class="numbertext">{{ $i }} / {{ count($slider) }}</div>
                <img class="slideImg" src="{{ $slide->getImagePath('image', 'full') }}" alt="{!! $slide->text !!}">
                <div class="text">
                    {!! $slide->text !!}
                </div>
            </div>

            @php $i++; @endphp
        @endforeach

        <a  class="prev" onclick="plusSlides(-1)">&#10094</a>
        <a  class="next" onclick="plusSlides(1)">&#10095</a>
    </div>
    <br>
    <div style="text-align: center;">
        @php $i = 1; @endphp
        @foreach($slider as $slide)
            <span class="dot" onclick="currentSlide({{ $i }})"></span>
            @php $i++; @endphp
        @endforeach
    </div>
@endif