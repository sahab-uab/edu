<div class="mt-14">
    <div class="safearea flex-col gap-3">
        <div class="owl-carousel owl-theme left-slider">
            @if ($reviews_data)
                @foreach ($reviews_data as $item)
                    @php
                        $name = array_key_first($item);
                        $details = $item[$name];
                    @endphp
                    <div class="item border border-gray-200 rounded-base p-4 bg-white">
                        <i class="ri-double-quotes-l text-3xl text-primary"></i>
                        <p class="text-sm text-gray-600 mt-4">{{ $details }}</p>
                        <h4 class="text-dark text-base font-semibold mt-2">{{ $name }}</h4>
                    </div>
                @endforeach
            @endif
        </div>

        <div class="owl-carousel owl-theme right-slider">
            @if ($reviews_data)
                @foreach ($reviews_data as $item)
                    @php
                        $name = array_key_first($item);
                        $details = $item[$name];
                    @endphp
                    <div class="item border border-gray-200 rounded-base p-4 bg-white" dir="ltr">
                        <i class="ri-double-quotes-l text-3xl text-primary text-left"></i>
                        <p class="text-sm text-gray-600 mt-4 text-start">{{ $details }}</p>
                        <h4 class="text-dark text-base font-semibold mt-2 text-start">{{ $name }}</h4>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@push('scripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <script>
        function sliderload() {
            $('.left-slider').owlCarousel({
                margin: 10,
                loop: true,
                dots: false,
                autoplay: true,
                autoplayTimeout: 3000, // স্লাইড বদলানোর মাঝে ৩ সেকেন্ডের অপেক্ষা
                autoplaySpeed: 2500, // slide animation speed (slow and smooth)
                autoplayHoverPause: true,
                smartSpeed: 2000, // transition speed, যত কম তত দ্রুত, বেশি মানে স্লো
                fluidSpeed: false, // fluidSpeed false করলে smartSpeed কাজ করবে ভালো
                autoplayDirection: 'left',
                responsive: {
                    0: {
                        items: 1 // ছোট ডিভাইসে ১টা আইটেম
                    },
                    600: {
                        items: 2 // 600px থেকে বড় হলে ২টা আইটেম
                    },
                    1000: {
                        items: 4 // 1000px বা তার বড় স্ক্রিনে ৪টা আইটেম
                    }
                }
            });

            $('.right-slider').owlCarousel({
                margin: 10,
                loop: true,
                dots: false,
                autoplay: true,
                autoplayTimeout: 3000, // স্লাইড বদলানোর মাঝে ৩ সেকেন্ডের অপেক্ষা
                autoplaySpeed: 2500, // slide animation speed (slow and smooth)
                autoplayHoverPause: true,
                smartSpeed: 2000,
                fluidSpeed: false,
                rtl: true,
                responsive: {
                    0: {
                        items: 1 // ছোট ডিভাইসে ১টা আইটেম
                    },
                    600: {
                        items: 2 // 600px থেকে বড় হলে ২টা আইটেম
                    },
                    1000: {
                        items: 4 // 1000px বা তার বড় স্ক্রিনে ৪টা আইটেম
                    }
                }
            });
        }
        document.addEventListener('livewire:init', () => {
            sliderload()
        });
        document.addEventListener('livewire:navigated', () => {
            sliderload()
        })
    </script>
@endpush
