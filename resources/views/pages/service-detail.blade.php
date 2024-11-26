@extends('layouts.layout')

@section('content')


    <div data-anim="fade" class="container">
        <div class="row justify-between py-30 mt-80">
            <div class="col-auto">
            <div class="text-14">Home > {{ $service->location }}</div>
            </div>

            <div class="col-auto">
            <div class="text-14">
                {{ $service->title }}
            </div>
            </div>
        </div>
    </div>    

    <section data-anim="slide-up delay-1" class="">
        <div class="container">
            <div class="row y-gap-20 justify-between items-end">
            <div class="col-auto">
                <div class="row x-gap-10 y-gap-10 items-center">
                <div class="col-auto">
                    <button
                    class="button -accent-1 text-14 py-5 px-15 bg-accent-1-05 text-accent-1 rounded-200"
                    >
                    Bestseller
                    </button>
                </div>
                <div class="col-auto">
                    <button
                    class="button -accent-1 text-14 py-5 px-15 bg-light-1 rounded-200"
                    >
                    Free cancellation
                    </button>
                </div>
                </div>

                <h2 class="text-40 sm:text-30 lh-14 mt-20">
                {{ $service->title }}
                </h2>

                <div class="row x-gap-20 y-gap-20 items-center pt-20">
                <div class="col-auto">
                    <div class="d-flex items-center">
                    <div class="d-flex x-gap-5 pr-10">
                        <i
                        class="flex-center icon-star text-yellow-2 text-12"
                        ></i>

                        <i
                        class="flex-center icon-star text-yellow-2 text-12"
                        ></i>

                        <i
                        class="flex-center icon-star text-yellow-2 text-12"
                        ></i>

                        <i
                        class="flex-center icon-star text-yellow-2 text-12"
                        ></i>

                        <i
                        class="flex-center icon-star text-yellow-2 text-12"
                        ></i>
                    </div>
                    4.9 (310)
                    </div>
                </div>

                <div class="col-auto">
                    <div class="d-flex items-center">
                    <i class="icon-pin text-16 mr-5"></i>
                    {{ $service->location }}, Morocco
                    </div>
                </div>

                <div class="col-auto">
                    <div class="d-flex items-center">
                    <i class="icon-reservation text-16 mr-5"></i>
                    10K+ booked
                    </div>
                </div>
                </div>
            </div>

            <div class="col-auto">
                <div class="d-flex x-gap-30 y-gap-10">
                <a href="#" class="d-flex items-center">
                    <i class="icon-share flex-center text-16 mr-10"></i>
                    Share
                </a>

                <a href="#" class="d-flex items-center">
                    <i class="icon-heart flex-center text-16 mr-10"></i>
                    Wishlist
                </a>
                </div>
            </div>
            </div>

            <div class="tourSingleGrid -type-2 mt-30">
            <div class="tourSingleGrid__grid mobile-css-slider-2">

                
                @if ($service->images->isNotEmpty())
                    <img 
                        src="{{ asset($service->images[0]->image_path) }}" 
                        alt="{{ $service->title }}" 
                        class="desktop-img-large" />

                    @if ($service->images->count() > 1)
                        <img 
                            src="{{ asset($service->images[1]->image_path) }}" 
                            alt="{{ $service->title }}" 
                            class="desktop-img-small" />
                    @endif

                    @if ($service->images->count() > 2)
                        <img 
                            src="{{ asset($service->images[2]->image_path) }}" 
                            alt="{{ $service->title }}" 
                            class="desktop-img-small" />
                    @endif
                @else
                    <p>No images available.</p>
                @endif



            </div>

            <div class="tourSingleGrid__button">


                @if ($service->images->isNotEmpty())
                     <a
                    href="{{ asset($service->images->last()->image_path) }}"
                    class="js-gallery"
                    data-gallery="gallery1"
                    >
                    <span
                        class="button -accent-1 py-10 px-20 rounded-200 bg-dark-1 lh-16 text-white"
                        >See all photos</span
                    >
                    </a>
                @else
                    <p>No image available.</p>
                @endif

               

                @foreach ($service->images as $image)
                    <a
                    href="{{ asset($image->image_path) }}"
                    class="js-gallery"
                    data-gallery="gallery1"
                    ></a>
                @endforeach
                
            </div>
            </div>
        </div>
    </section>

    <section class="layout-pt-md js-pin-container">
        <div class="container">
            <div class="row y-gap-30 justify-between">
            <div class="col-lg-8">
                <div
                class="row y-gap-20 justify-between items-center layout-pb-md"
                >
                <div class="col-lg-3 col-6">
                    <div class="d-flex items-center">
                    <div class="flex-center size-50 rounded-12 border-1">
                        <i class="text-20 icon-clock"></i>
                    </div>

                    <div class="ml-10">
                        <div class="lh-16">Duration</div>
                        <div class="text-14 text-light-2 lh-16">{{ $service->duration }}</div>
                    </div>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="d-flex items-center">
                    <div class="flex-center size-50 rounded-12 border-1">
                        <i class="text-20 icon-teamwork"></i>
                    </div>
                    <div class="ml-10">
                        <div class="lh-16">Group Size</div>
                        <div class="text-14 text-light-2 lh-16">{{ $service->max_participants }} people</div>
                    </div>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="d-flex items-center">
                    <div class="flex-center size-50 rounded-12 border-1">
                        <i class="text-20 icon-birthday-cake"></i>
                    </div>
                    <div class="ml-10">
                        <div class="lh-16">Ages</div>
                        <div class="text-14 text-light-2 lh-16">{{ $service->min_age }}+ yrs</div>
                    </div>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="d-flex items-center">
                    <div class="flex-center size-50 rounded-12 border-1">
                        <i class="text-20 icon-translate"></i>
                    </div>
                    <div class="ml-10">
                        <div class="lh-16">Languages</div>
                        <div class="text-14 text-light-2 lh-16">
                        English, French
                        </div>
                    </div>
                    </div>
                </div>
                </div>

                <h2 class="text-30">Tour Overview</h2>
                <p class="mt-20">
                {{ $service->overview }}
                </p>


                <h3 class="text-20 fw-500 mt-20">Details</h3>


                <p class="mt-20">
                {{ $service->description }}
                </p>


                <div
                class="accordion -tour-single row y-gap-20 pt-60 md:pt-30 js-accordion"
                >
                <div class="col-12">


                <div class="accordion__item py-30 border-1-top">
                        <div
                            class="accordion__button d-flex items-center justify-between"
                        >
                            <div class="text-30 md:text-20 lh-13 fw-700">
                            Highlights
                            </div>

                            <div class="accordion__icon size-30 text-24 flex-center">
                            <i class="icon-chevron-down"></i>
                            <i class="icon-chevron-up"></i>
                            </div>
                        </div>

                        <div class="accordion__content">
                            <div class="pt-20">
                            <div class="roadmap">
                                <div class="roadmap__item">
                                    <div class="roadmap__iconBig">
                                        <i class="icon-pin"></i>
                                    </div>
                                    <div class="roadmap__wrap">
                            
                                    </div>
                                </div>


                                @foreach ($service->highlights as $highlight)
                                    <div class="roadmap__item">
                                        <div class="roadmap__icon"></div>
                                        <div class="roadmap__wrap">
                                            <div class="roadmap__title">
                                            {{ $highlight->text }}
                                            </div>
                                        
                                        </div>
                                    </div>
                                @endforeach
                        
                            
                                <div class="roadmap__item">
                                <div class="roadmap__icon"></div>
                                <div class="roadmap__wrap">
                                    <div class="roadmap__title">
                                    Day 6: Morning Chill &amp; Muay Thai Lesson
                                    </div>
                                </div>
                                </div>

                                <div class="roadmap__item">
                                <div class="roadmap__iconBig">
                                    <i class="icon-flag"></i>
                                </div>
                                <div class="roadmap__wrap">
                                
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>


                    <div class="accordion__item py-30 border-1-top">
                        <div
                            class="accordion__button d-flex items-center justify-between"
                        >
                            <div class="text-30 md:text-20 lh-13 fw-700">
                            What's included
                            </div>

                            <div class="accordion__icon size-30 text-24 flex-center">
                            <i class="icon-chevron-down"></i>
                            <i class="icon-chevron-up"></i>
                            </div>
                        </div>

                        <div class="accordion__content">
                            <div class="pt-20">
                                <div class="row x-gap-130 y-gap-20 pt-20">
                                    <div class="col-lg-12">
                                        <div class="y-gap-15">

                                            @foreach ($service->inclusions as $inclusion)
                                                <div class="d-flex">

                                            
                                                    <i
                                                        class="icon-check flex-center text-10 size-24 rounded-full text-green-2 bg-green-1 mr-15"
                                                    ></i>
                                                    {{ $inclusion->text }}
                                                </div>

                                            @endforeach

                                        
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="accordion__item py-30 border-1-top">
                        <div
                            class="accordion__button d-flex items-center justify-between"
                        >
                            <div class="text-30 md:text-20 lh-13 fw-700">
                            Important Informations
                            </div>

                            <div class="accordion__icon size-30 text-24 flex-center">
                            <i class="icon-chevron-down"></i>
                            <i class="icon-chevron-up"></i>
                            </div>
                        </div>

                        <div class="accordion__content">
                            <div class="pt-20">

                                <ul class="ulList mt-20">

                                    @foreach ($service->importantInfos as $info)
                                        <li>{{ $info->text }}</li>
                                    @endforeach

                                  
                                </ul>

                               
                            </div>
                        </div>
                    </div>

                    

                    

                </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="d-flex justify-end js-pin-content">
                <div class="tourSingleSidebar">
    


                    <div class="d-flex items-center justify-between">
                        <div class="text-18 fw-500">Total:</div>
                        <div class="text-18 fw-500">${{ $service->price }}</div>
                    </div>

                    <button
                    class="button -md -dark-1 col-12 bg-accent-1 text-white mt-20"
                    >
                    Book Now
                    <i class="icon-arrow-top-right ml-10"></i>
                    </button>
                </div>
                </div>
            </div>
            </div>
        </div>
    </section>

@endsection
