

@extends('layouts.layout')

@section('content')
<section data-anim-wrap class="hero -type-3">
    <div data-anim-child="slide-up" class="hero__bg">
        <img src="img/hero/3/bg.jpg" alt="background" />
    </div>

    <div class="container">
        <div data-anim-child="slide-up delay-2" class="row justify-between">
        <div class="col-xl-5 col-lg-5">
            <div class="hero__subtitle mb-20 md:mb-10">
            Your Adventure Begins Here for a World of Discovery!
            </div>

            <h1 class="hero__title">
            Experience Morocco's Wonders with Marrakech Sweet Travel, Your
            Journey, Perfectly Guided

            <img src="img/hero/3/brush.svg" alt="brush stroke" />
            </h1>

            <div class="hero__filter mt-60 lg:mt-30">
            <div class="searchForm -type-1 shadow-1">
                <div class="searchForm__form">
                <div class="searchFormItem js-select-control js-form-dd">
                    <div
                    class="searchFormItem__button"
                    data-x-click="location"
                    >
                    <div
                        class="searchFormItem__icon size-50 rounded-full bg-accent-1-05 flex-center"
                    >
                        <i class="text-20 icon-pin"></i>
                    </div>
                    <div class="searchFormItem__content">
                        <h5>Where</h5>
                        <div class="js-select-control-chosen">
                        Search destinations
                        </div>
                    </div>
                    </div>

                    <div
                    class="searchFormItemDropdown -location"
                    data-x="location"
                    data-x-toggle="is-active"
                    >
                    <div class="searchFormItemDropdown__container">
                        <div class="searchFormItemDropdown__list sroll-bar-1">
                        <div class="searchFormItemDropdown__item">
                            <button class="js-select-control-button">
                            <span class="js-select-control-choice"
                                >Jemaa el-Fnaa Square
                            </span>
                            </button>
                        </div>

                        <div class="searchFormItemDropdown__item">
                            <button class="js-select-control-button">
                            <span class="js-select-control-choice"
                                >Medina of Marrakech</span
                            >
                            </button>
                        </div>

                        <div class="searchFormItemDropdown__item">
                            <button class="js-select-control-button">
                            <span class="js-select-control-choice"
                                >Koutoubia Mosque</span
                            >
                            </button>
                        </div>

                        <div class="searchFormItemDropdown__item">
                            <button class="js-select-control-button">
                            <span class="js-select-control-choice"
                                >Majorelle Garden</span
                            >
                            </button>
                        </div>

                        <div class="searchFormItemDropdown__item">
                            <button class="js-select-control-button">
                            <span class="js-select-control-choice"
                                >The Palmeraie</span
                            >
                            </button>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>

                <div
                    class="searchFormItem js-select-control js-form-dd js-calendar"
                >
                    <div
                    class="searchFormItem__button"
                    data-x-click="calendar"
                    >
                    <div
                        class="searchFormItem__icon size-50 rounded-full bg-accent-1-05 flex-center"
                    >
                        <i class="text-20 icon-calendar"></i>
                    </div>
                    <div class="searchFormItem__content">
                        <h5>When</h5>
                        <div>
                        <span class="js-first-date">Add dates</span>
                        <span class="js-last-date"></span>
                        </div>
                    </div>
                    </div>

                    <div
                    class="searchFormItemDropdown -calendar"
                    data-x="calendar"
                    data-x-toggle="is-active"
                    >
                    <div class="searchFormItemDropdown__container">
                        <div
                        class="searchMenu-date -searchForm js-form-dd js-calendar-el"
                        >
                        <div
                            class="searchMenu-date__field shadow-2"
                            data-x-dd="searchMenu-date"
                            data-x-dd-toggle="-is-active"
                        >
                            <div class="bg-white rounded-4">
                            <div
                                class="elCalendar js-calendar-el-calendar"
                            ></div>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>

                <div class="searchFormItem js-select-control js-form-dd">
                    <div
                    class="searchFormItem__button"
                    data-x-click="tour-type"
                    >
                    <div
                        class="searchFormItem__icon size-50 rounded-full bg-accent-1-05 flex-center"
                    >
                        <i class="text-20 icon-flag"></i>
                    </div>
                    <div class="searchFormItem__content">
                        <h5>Tour Type</h5>
                        <div class="js-select-control-chosen">All tour</div>
                    </div>
                    </div>

                    <div
                    class="searchFormItemDropdown -tour-type"
                    data-x="tour-type"
                    data-x-toggle="is-active"
                    >
                    <div class="searchFormItemDropdown__container">
                        <div class="searchFormItemDropdown__list sroll-bar-1">
                        <div class="searchFormItemDropdown__item">
                            <button class="js-select-control-button">
                            <span class="js-select-control-choice"
                                >City Tour</span
                            >
                            </button>
                        </div>

                        <div class="searchFormItemDropdown__item">
                            <button class="js-select-control-button">
                            <span class="js-select-control-choice"
                                >Hiking</span
                            >
                            </button>
                        </div>

                        <div class="searchFormItemDropdown__item">
                            <button class="js-select-control-button">
                            <span class="js-select-control-choice"
                                >Food Tour</span
                            >
                            </button>
                        </div>

                        <div class="searchFormItemDropdown__item">
                            <button class="js-select-control-button">
                            <span class="js-select-control-choice"
                                >Cultural Tours</span
                            >
                            </button>
                        </div>

                        <div class="searchFormItemDropdown__item">
                            <button class="js-select-control-button">
                            <span class="js-select-control-choice"
                                >Museums Tours</span
                            >
                            </button>
                        </div>

                        <div class="searchFormItemDropdown__item">
                            <button class="js-select-control-button">
                            <span class="js-select-control-choice"
                                >Beach Tours</span
                            >
                            </button>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>

                <div class="searchForm__button">
                <button
                    class="button -dark-1 bg-accent-1 rounded-200 text-white"
                >
                    <i class="icon-search text-16 mr-10"></i>
                    Search
                </button>
                </div>
            </div>
            </div>
        </div>

        <div class="col-xl-7 col-lg-7">
            <div class="hero__image">
            <div>
                <img src="img/hero/3/1.png" alt="image" />
            </div>
            <img src="img/hero/3/3.png" alt="image" />
            </div>
        </div>
        </div>
    </div>
</section>

<section class="layout-pt-xl layout-pb-xl">
    <div class="container">
        <div class="row justify-center text-center">
        <div class="col-auto">
            <h2 class="text-30">Trusted by All The Largest Travel Brands</h2>
        </div>
        </div>

        <div class="row y-gap-30 justify-between pt-40 sm:pt-20">
        <div class="col-md-auto col-6">
            <img src="img/clients/1/1.svg" alt="image" style="width: 150px" />
        </div>

        <div class="col-md-auto col-6">
            <img src="img/clients/1/2.svg" alt="image" style="width: 150px" />
        </div>

        <div class="col-md-auto col-6">
            <img src="img/clients/1/3.svg" alt="image" style="width: 150px" />
        </div>

        <div class="col-md-auto col-6">
            <img src="img/clients/1/4.svg" alt="image" style="width: 150px" />
        </div>

        <div class="col-md-auto col-6">
            <img src="img/clients/1/5.svg" alt="image" style="width: 150px" />
        </div>

        <div class="col-md-auto col-6">
            <img src="img/clients/1/6.svg" alt="image" style="width: 150px" />
        </div>
        </div>
    </div>
</section>

<section class="layout-pt-xl">
    <div data-anim-wrap class="container">
        <div
        data-anim-child="slide-up"
        class="row justify-between items-end y-gap-10"
        >
        <div class="col-auto">
            <h2 class="text-30">Shop Tickets & Tours</h2>
        </div>

        <div class="col-auto">
            <button class="buttonArrow d-flex items-center">
            <span>See all</span>
            <i class="icon-arrow-top-right text-16 ml-10"></i>
            </button>
        </div>
        </div>

        <div
        data-anim-child="slide-up delay-2"
        class="row y-gap-30 pt-40 sm:pt-20"
        >
        <div class="col-lg-2 col-md-3 col-6">
            <a href="#" class="featureCard -type-2 -hover-image-scale">
            <div
                class="featureCard__image ratio ratio-19:22 -hover-image-scale__image rounded-12"
            >
                <img
                src="img/destinationCards/3/1.jpg"
                alt="image"
                class="img-ratio rounded-12"
                />
            </div>

            <div class="featureCard__content text-center">
                <h4 class="text-white text-18">City Tours</h4>
                <div class="text-14 text-white">100+ Tours</div>
            </div>
            </a>
        </div>

        <div class="col-lg-2 col-md-3 col-6">
            <a href="#" class="featureCard -type-2 -hover-image-scale">
            <div
                class="featureCard__image ratio ratio-19:22 -hover-image-scale__image rounded-12"
            >
                <img
                src="img/destinationCards/3/2.jpg"
                alt="image"
                class="img-ratio rounded-12"
                />
            </div>

            <div class="featureCard__content text-center">
                <h4 class="text-white text-18">Cultural Tours</h4>
                <div class="text-14 text-white">100+ Tours</div>
            </div>
            </a>
        </div>

        <div class="col-lg-2 col-md-3 col-6">
            <a href="#" class="featureCard -type-2 -hover-image-scale">
            <div
                class="featureCard__image ratio ratio-19:22 -hover-image-scale__image rounded-12"
            >
                <img
                src="img/destinationCards/3/3.jpg"
                alt="image"
                class="img-ratio rounded-12"
                />
            </div>

            <div class="featureCard__content text-center">
                <h4 class="text-white text-18">Day Cruises</h4>
                <div class="text-14 text-white">100+ Tours</div>
            </div>
            </a>
        </div>

        <div class="col-lg-2 col-md-3 col-6">
            <a href="#" class="featureCard -type-2 -hover-image-scale">
            <div
                class="featureCard__image ratio ratio-19:22 -hover-image-scale__image rounded-12"
            >
                <img
                src="img/destinationCards/3/4.jpg"
                alt="image"
                class="img-ratio rounded-12"
                />
            </div>

            <div class="featureCard__content text-center">
                <h4 class="text-white text-18">Bus Tours</h4>
                <div class="text-14 text-white">100+ Tours</div>
            </div>
            </a>
        </div>

        <div class="col-lg-2 col-md-3 col-6">
            <a href="#" class="featureCard -type-2 -hover-image-scale">
            <div
                class="featureCard__image ratio ratio-19:22 -hover-image-scale__image rounded-12"
            >
                <img
                src="img/destinationCards/3/5.jpg"
                alt="image"
                class="img-ratio rounded-12"
                />
            </div>

            <div class="featureCard__content text-center">
                <h4 class="text-white text-18">Beach Tours</h4>
                <div class="text-14 text-white">100+ Tours</div>
            </div>
            </a>
        </div>

        <div class="col-lg-2 col-md-3 col-6">
            <a href="#" class="featureCard -type-2 -hover-image-scale">
            <div
                class="featureCard__image ratio ratio-19:22 -hover-image-scale__image rounded-12"
            >
                <img
                src="img/destinationCards/3/6.jpg"
                alt="image"
                class="img-ratio rounded-12"
                />
            </div>

            <div class="featureCard__content text-center">
                <h4 class="text-white text-18">Food Tours</h4>
                <div class="text-14 text-white">100+ Tours</div>
            </div>
            </a>
        </div>
        </div>
    </div>
</section>

<section class="layout-pt-xl">
    <div data-anim-wrap class="container">
        <div
        data-anim-child="slide-up"
        class="row y-gap-10 justify-between items-center y-gap-10"
        >
        <div class="col-auto">
            <h2 class="text-30">Ways to Experience Marrakech Sweet Travel</h2>
        </div>
        </div>

        <div
        data-anim-child="slide-up delay-2"
        class="relative pt-40 sm:pt-20"
        >
        <div
            class="overflow-hidden js-section-slider"
            data-gap="30"
            data-slider-cols="xl-4 lg-3 md-2 sm-1 base-1"
            data-nav-prev="js-slider1-prev"
            data-nav-next="js-slider1-next"
        >
            <div class="swiper-wrapper">
            <div class="swiper-slide">
                <a
                href="#"
                class="tourCard -type-1 d-block border-1 bg-white hover-shadow-1 overflow-hidden rounded-12 bg-white -hover-shadow"
                >
                <div class="tourCard__header">
                    <div class="tourCard__image ratio ratio-28:20">
                    <img
                        src="img/tourCards/1.png"
                        alt="Marrakech City Tour"
                        class="img-ratio"
                    />
                    </div>
                    <button class="tourCard__favorite">
                    <i class="icon-heart"></i>
                    </button>
                </div>
                <div class="tourCard__content px-20 py-10">
                    <div
                    class="tourCard__location d-flex items-center text-13 text-light-2"
                    >
                    <i
                        class="icon-pin d-flex text-16 text-light-2 mr-5"
                    ></i>
                    Marrakech, Morocco
                    </div>
                    <h3 class="tourCard__title text-16 fw-500 mt-5">
                    <span>Full-Day Guided Marrakech City Tour</span>
                    </h3>
                    <div class="tourCard__rating text-13 mt-5">
                    <div class="d-flex items-center">
                        <div class="d-flex x-gap-5">
                        <div>
                            <i class="icon-star text-10 text-yellow-2"></i>
                        </div>
                        <div>
                            <i class="icon-star text-10 text-yellow-2"></i>
                        </div>
                        <div>
                            <i class="icon-star text-10 text-yellow-2"></i>
                        </div>
                        <div>
                            <i class="icon-star text-10 text-yellow-2"></i>
                        </div>
                        <div>
                            <i class="icon-star text-10 text-yellow-2"></i>
                        </div>
                        </div>
                        <span class="text-dark-1 ml-10">4.9 (320)</span>
                    </div>
                    </div>
                    <div
                    class="d-flex justify-between items-center border-1-top text-13 text-dark-1 pt-10 mt-10"
                    >
                    <div class="d-flex items-center">
                        <i class="icon-clock text-16 mr-5"></i>
                        1 day
                    </div>
                    <div>
                        From <span class="text-16 fw-500">$65.00</span>
                    </div>
                    </div>
                </div>
                </a>
            </div>

            <div class="swiper-slide">
                <a
                href="#"
                class="tourCard -type-1 d-block border-1 bg-white hover-shadow-1 overflow-hidden rounded-12 bg-white -hover-shadow"
                >
                <div class="tourCard__header">
                    <div class="tourCard__image ratio ratio-28:20">
                    <img
                        src="img/tourCards/2.png"
                        alt="Atlas Mountains Tour"
                        class="img-ratio"
                    />
                    </div>
                    <button class="tourCard__favorite">
                    <i class="icon-heart"></i>
                    </button>
                </div>
                <div class="tourCard__content px-20 py-10">
                    <div
                    class="tourCard__location d-flex items-center text-13 text-light-2"
                    >
                    <i
                        class="icon-pin d-flex text-16 text-light-2 mr-5"
                    ></i>
                    Atlas Mountains, Morocco
                    </div>
                    <h3 class="tourCard__title text-16 fw-500 mt-5">
                    <span>Atlas Mountains & Berber Villages Day Trip</span>
                    </h3>
                    <div class="tourCard__rating text-13 mt-5">
                    <div class="d-flex items-center">
                        <div class="d-flex x-gap-5">
                        <div>
                            <i class="icon-star text-10 text-yellow-2"></i>
                        </div>
                        <div>
                            <i class="icon-star text-10 text-yellow-2"></i>
                        </div>
                        <div>
                            <i class="icon-star text-10 text-yellow-2"></i>
                        </div>
                        <div>
                            <i class="icon-star text-10 text-yellow-2"></i>
                        </div>
                        <div>
                            <i class="icon-star text-10 text-yellow-2"></i>
                        </div>
                        </div>
                        <span class="text-dark-1 ml-10">4.8 (275)</span>
                    </div>
                    </div>
                    <div
                    class="d-flex justify-between items-center border-1-top text-13 text-dark-1 pt-10 mt-10"
                    >
                    <div class="d-flex items-center">
                        <i class="icon-clock text-16 mr-5"></i>
                        1 day
                    </div>
                    <div>
                        From <span class="text-16 fw-500">$85.00</span>
                    </div>
                    </div>
                </div>
                </a>
            </div>

            <div class="swiper-slide">
                <a
                href="#"
                class="tourCard -type-1 d-block border-1 bg-white hover-shadow-1 overflow-hidden rounded-12 bg-white -hover-shadow"
                >
                <div class="tourCard__header">
                    <div class="tourCard__image ratio ratio-28:20">
                    <img
                        src="img/tourCards/3.png"
                        alt="Camel Ride in Agafay"
                        class="img-ratio"
                    />
                    </div>
                    <button class="tourCard__favorite">
                    <i class="icon-heart"></i>
                    </button>
                </div>
                <div class="tourCard__content px-20 py-10">
                    <div
                    class="tourCard__location d-flex items-center text-13 text-light-2"
                    >
                    <i
                        class="icon-pin d-flex text-16 text-light-2 mr-5"
                    ></i>
                    Agafay Desert, Morocco
                    </div>
                    <h3 class="tourCard__title text-16 fw-500 mt-5">
                    <span
                        >Sunset Camel Ride & Dinner in the Agafay Desert</span
                    >
                    </h3>
                    <div class="tourCard__rating text-13 mt-5">
                    <div class="d-flex items-center">
                        <div class="d-flex x-gap-5">
                        <div>
                            <i class="icon-star text-10 text-yellow-2"></i>
                        </div>
                        <div>
                            <i class="icon-star text-10 text-yellow-2"></i>
                        </div>
                        <div>
                            <i class="icon-star text-10 text-yellow-2"></i>
                        </div>
                        <div>
                            <i class="icon-star text-10 text-yellow-2"></i>
                        </div>
                        <div>
                            <i class="icon-star text-10 text-yellow-2"></i>
                        </div>
                        </div>
                        <span class="text-dark-1 ml-10">4.7 (198)</span>
                    </div>
                    </div>
                    <div
                    class="d-flex justify-between items-center border-1-top text-13 text-dark-1 pt-10 mt-10"
                    >
                    <div class="d-flex items-center">
                        <i class="icon-clock text-16 mr-5"></i>
                        5 hours
                    </div>
                    <div>
                        From <span class="text-16 fw-500">$45.00</span>
                    </div>
                    </div>
                </div>
                </a>
            </div>

            <div class="swiper-slide">
                <a
                href="#"
                class="tourCard -type-1 d-block border-1 bg-white hover-shadow-1 overflow-hidden rounded-12 bg-white -hover-shadow"
                >
                <div class="tourCard__header">
                    <div class="tourCard__image ratio ratio-28:20">
                    <img
                        src="img/tourCards/4.png"
                        alt="Essaouira Day Trip"
                        class="img-ratio"
                    />
                    </div>
                    <button class="tourCard__favorite">
                    <i class="icon-heart"></i>
                    </button>
                </div>
                <div class="tourCard__content px-20 py-10">
                    <div
                    class="tourCard__location d-flex items-center text-13 text-light-2"
                    >
                    <i
                        class="icon-pin d-flex text-16 text-light-2 mr-5"
                    ></i>
                    Essaouira, Morocco
                    </div>
                    <h3 class="tourCard__title text-16 fw-500 mt-5">
                    <span>Essaouira Full-Day Excursion from Marrakech</span>
                    </h3>
                    <div class="tourCard__rating text-13 mt-5">
                    <div class="d-flex items-center">
                        <div class="d-flex x-gap-5">
                        <div>
                            <i class="icon-star text-10 text-yellow-2"></i>
                        </div>
                        <div>
                            <i class="icon-star text-10 text-yellow-2"></i>
                        </div>
                        <div>
                            <i class="icon-star text-10 text-yellow-2"></i>
                        </div>
                        <div>
                            <i class="icon-star text-10 text-yellow-2"></i>
                        </div>
                        <div>
                            <i class="icon-star text-10 text-yellow-2"></i>
                        </div>
                        </div>
                        <span class="text-dark-1 ml-10">4.8 (255)</span>
                    </div>
                    </div>
                    <div
                    class="d-flex justify-between items-center border-1-top text-13 text-dark-1 pt-10 mt-10"
                    >
                    <div class="d-flex items-center">
                        <i class="icon-clock text-16 mr-5"></i>
                        1 day
                    </div>
                    <div>
                        From <span class="text-16 fw-500">$75.00</span>
                    </div>
                    </div>
                </div>
                </a>
            </div>

            <div class="swiper-slide">
                <a
                href="#"
                class="tourCard -type-1 d-block border-1 bg-white hover-shadow-1 overflow-hidden rounded-12 bg-white -hover-shadow"
                >
                <div class="tourCard__header">
                    <div class="tourCard__image ratio ratio-28:20">
                    <img
                        src="img/tourCards/5.png"
                        alt="Ouzoud Waterfalls Tour"
                        class="img-ratio"
                    />
                    </div>
                    <button class="tourCard__favorite">
                    <i class="icon-heart"></i>
                    </button>
                </div>
                <div class="tourCard__content px-20 py-10">
                    <div
                    class="tourCard__location d-flex items-center text-13 text-light-2"
                    >
                    <i
                        class="icon-pin d-flex text-16 text-light-2 mr-5"
                    ></i>
                    Ouzoud, Morocco
                    </div>
                    <h3 class="tourCard__title text-16 fw-500 mt-5">
                    <span>Ouzoud Waterfalls Day Tour from Marrakech</span>
                    </h3>
                    <div class="tourCard__rating text-13 mt-5">
                    <div class="d-flex items-center">
                        <div class="d-flex x-gap-5">
                        <div>
                            <i class="icon-star text-10 text-yellow-2"></i>
                        </div>
                        <div>
                            <i class="icon-star text-10 text-yellow-2"></i>
                        </div>
                        <div>
                            <i class="icon-star text-10 text-yellow-2"></i>
                        </div>
                        <div>
                            <i class="icon-star text-10 text-yellow-2"></i>
                        </div>
                        <div>
                            <i class="icon-star text-10 text-yellow-2"></i>
                        </div>
                        </div>
                        <span class="text-dark-1 ml-10">4.9 (305)</span>
                    </div>
                    </div>
                    <div
                    class="d-flex justify-between items-center border-1-top text-13 text-dark-1 pt-10 mt-10"
                    >
                    <div class="d-flex items-center">
                        <i class="icon-clock text-16 mr-5"></i>
                        1 day
                    </div>
                    <div>
                        From <span class="text-16 fw-500">$70.00</span>
                    </div>
                    </div>
                </div>
                </a>
            </div>
            </div>
        </div>

        <div class="navAbsolute">
            <button class="navAbsolute__button bg-white js-slider1-prev">
            <i class="icon-arrow-left text-14"></i>
            </button>

            <button class="navAbsolute__button bg-white js-slider1-next">
            <i class="icon-arrow-right text-14"></i>
            </button>
        </div>
        </div>
    </div>
</section>

<section class="layout-pt-xl layout-pb-xl">
    <div data-anim-wrap class="container">
        <div
        data-anim-child="slide-up"
        class="row justify-between items-end y-gap-10"
        >
        <div class="col-auto">
            <h2 class="text-30">Trending Destinations</h2>
        </div>

        <div class="col-auto">
            <button class="buttonArrow d-flex items-center">
            <span>See all</span>
            <i class="icon-arrow-top-right text-16 ml-10"></i>
            </button>
        </div>
        </div>

        <div class="grid -type-2 pt-40 sm:pt-20">
        <a
            href="#"
            data-anim-child="slide-up delay-1"
            class="featureCard -type-1 overflow-hidden rounded-12 px-30 py-30 -hover-image-scale"
        >
            <div class="featureCard__image -hover-image-scale__image">
            <img src="img/features/2/1.jpg" alt="image" />
            </div>

            <div class="featureCard__content">
            <h4 class="text-white">Ouzoud</h4>
            </div>
        </a>

        <a
            href="#"
            data-anim-child="slide-up delay-2"
            class="featureCard -type-1 overflow-hidden rounded-12 px-30 py-30 -hover-image-scale"
        >
            <div class="featureCard__image -hover-image-scale__image">
            <img src="img/features/2/2.jpg" alt="image" />
            </div>

            <div class="featureCard__content">
            <h4 class="text-white">Agafay</h4>
            </div>
        </a>

        <a
            href="#"
            data-anim-child="slide-up delay-3"
            class="featureCard -type-1 overflow-hidden rounded-12 px-30 py-30 -hover-image-scale"
        >
            <div class="featureCard__image -hover-image-scale__image">
            <img src="img/features/2/3.jpg" alt="image" />
            </div>

            <div class="featureCard__content">
            <h4 class="text-white">Ourika</h4>
            </div>
        </a>

        <a
            href="#"
            data-anim-child="slide-up delay-4"
            class="featureCard -type-1 overflow-hidden rounded-12 px-30 py-30 -hover-image-scale"
        >
            <div class="featureCard__image -hover-image-scale__image">
            <img src="img/features/2/4.jpg" alt="image" />
            </div>

            <div class="featureCard__content">
            <h4 class="text-white">Imlil</h4>
            </div>
        </a>

        <a
            href="#"
            data-anim-child="slide-up delay-5"
            class="featureCard -type-1 overflow-hidden rounded-12 px-30 py-30 -hover-image-scale"
        >
            <div class="featureCard__image -hover-image-scale__image">
            <img src="img/features/2/5.jpg" alt="image" />
            </div>

            <div class="featureCard__content">
            <h4 class="text-white">Majorelle</h4>
            </div>
        </a>

        <a
            href="#"
            data-anim-child="slide-up delay-6"
            class="featureCard -type-1 overflow-hidden rounded-12 px-30 py-30 -hover-image-scale"
        >
            <div class="featureCard__image -hover-image-scale__image">
            <img src="img/features/2/6.jpg" alt="image" />
            </div>

            <div class="featureCard__content">
            <h4 class="text-white">Essaouira</h4>
            </div>
        </a>
        </div>
    </div>
</section>

<section class="layout-pt-xl layout-pb-xl bg-accent-1-05">
    <div data-anim-wrap class="container">
        <div
        data-anim-child="slide-up"
        class="row justify-center text-center"
        >
        <div class="col-auto">
            <h2 class="text-30">
            Unforgettable Experiences Shared by Our Guests
            </h2>
        </div>
        </div>

        <div
        data-anim-child="slide-up delay-2"
        class="row justify-center pt-60 md:pt-30"
        >
        <div class="col-xl-7 col-md-8 col-sm-10">
            <div class="overflow-hidden js-testimonialsSlider_1">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                <div class="testimonials -type-2 text-center">
                    <div class="testimonials__icon">
                    <svg
                        width="60"
                        height="43"
                        viewBox="0 0 60 43"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                        d="M14.837 42.0652C11.0326 42.0652 7.6087 40.5435 4.56522 37.5C1.52174 34.3478 0 29.7283 0 23.6413C0 16.6848 1.84783 11.0326 5.54348 6.68478C9.34783 2.22825 14.7283 0 21.6848 0C24.1848 0 26.1413 0.163038 27.5543 0.489121V7.98912C26.0326 7.77173 24.0761 7.66304 21.6848 7.66304C17.9891 7.66304 15 8.91304 12.7174 11.413C10.5435 13.5869 9.29348 16.4674 8.96739 20.0543C10.3804 18.3152 12.663 17.4456 15.8152 17.4456C19.0761 17.4456 21.8478 18.587 24.1304 20.8696C26.413 23.0435 27.5543 25.9239 27.5543 29.5109C27.5543 33.2065 26.3587 36.25 23.9674 38.6413C21.5761 40.9239 18.5326 42.0652 14.837 42.0652ZM47.2826 42.0652C43.4783 42.0652 40.0543 40.5435 37.0109 37.5C33.9674 34.3478 32.4456 29.7283 32.4456 23.6413C32.4456 16.6848 34.2935 11.0326 37.9891 6.68478C41.7935 2.22825 47.1739 0 54.1304 0C56.6304 0 58.587 0.163038 60 0.489121V7.98912C58.4783 7.77173 56.5217 7.66304 54.1304 7.66304C50.4348 7.66304 47.4456 8.91304 45.163 11.413C42.9891 13.5869 41.7391 16.4674 41.413 20.0543C42.8261 18.3152 45.1087 17.4456 48.2609 17.4456C51.5217 17.4456 54.2935 18.587 56.5761 20.8696C58.8587 23.0435 60 25.9239 60 29.5109C60 33.2065 58.8043 36.25 56.413 38.6413C54.0217 40.9239 50.9783 42.0652 47.2826 42.0652Z"
                        fill="#F6B231"
                        />
                    </svg>
                    </div>

                    <div class="text-20 md:text-18 fw-400 mt-60 md:mt-30">
                    <b>Unforgettable Experience</b><br />
                    Marrakech Sweet Travel provided excellent services for
                    my friends and me during our stay in Marrakech. We
                    booked a guided tour of Marrakech with an excellent and
                    knowledgeable guide, Ali, who made sure we had a nice
                    traditional breakfast before we started our tour. He
                    showed us around Bahia Palace, the Médina, and took us
                    to the Majorelle Gardens. He was full of energy and a
                    really kind person.
                    </div>
                </div>
                </div>

                <div class="swiper-slide">
                <div class="testimonials -type-2 text-center">
                    <div class="testimonials__icon">
                    <svg
                        width="60"
                        height="43"
                        viewBox="0 0 60 43"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                        d="M14.837 42.0652C11.0326 42.0652 7.6087 40.5435 4.56522 37.5C1.52174 34.3478 0 29.7283 0 23.6413C0 16.6848 1.84783 11.0326 5.54348 6.68478C9.34783 2.22825 14.7283 0 21.6848 0C24.1848 0 26.1413 0.163038 27.5543 0.489121V7.98912C26.0326 7.77173 24.0761 7.66304 21.6848 7.66304C17.9891 7.66304 15 8.91304 12.7174 11.413C10.5435 13.5869 9.29348 16.4674 8.96739 20.0543C10.3804 18.3152 12.663 17.4456 15.8152 17.4456C19.0761 17.4456 21.8478 18.587 24.1304 20.8696C26.413 23.0435 27.5543 25.9239 27.5543 29.5109C27.5543 33.2065 26.3587 36.25 23.9674 38.6413C21.5761 40.9239 18.5326 42.0652 14.837 42.0652ZM47.2826 42.0652C43.4783 42.0652 40.0543 40.5435 37.0109 37.5C33.9674 34.3478 32.4456 29.7283 32.4456 23.6413C32.4456 16.6848 34.2935 11.0326 37.9891 6.68478C41.7935 2.22825 47.1739 0 54.1304 0C56.6304 0 58.587 0.163038 60 0.489121V7.98912C58.4783 7.77173 56.5217 7.66304 54.1304 7.66304C50.4348 7.66304 47.4456 8.91304 45.163 11.413C42.9891 13.5869 41.7391 16.4674 41.413 20.0543C42.8261 18.3152 45.1087 17.4456 48.2609 17.4456C51.5217 17.4456 54.2935 18.587 56.5761 20.8696C58.8587 23.0435 60 25.9239 60 29.5109C60 33.2065 58.8043 36.25 56.413 38.6413C54.0217 40.9239 50.9783 42.0652 47.2826 42.0652Z"
                        fill="#F6B231"
                        />
                    </svg>
                    </div>

                    <div class="text-20 md:text-18 fw-400 mt-60 md:mt-30">
                    <b>Great Service, Would Definitely Recommend!</b><br />
                    We booked a day trip to Ourika Valley where we chose to
                    do the 2-hour hike to see the waterfalls. We also had a
                    really helpful guide called Saeed who was very caring
                    and careful, especially because we had one member of our
                    group who was afraid of heights. The views were
                    stunning. Overall, we had a very nice experience and I
                    really recommend booking this day trip with them.
                    </div>
                </div>
                </div>

                <div class="swiper-slide">
                <div class="testimonials -type-2 text-center">
                    <div class="testimonials__icon">
                    <svg
                        width="60"
                        height="43"
                        viewBox="0 0 60 43"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                        d="M14.837 42.0652C11.0326 42.0652 7.6087 40.5435 4.56522 37.5C1.52174 34.3478 0 29.7283 0 23.6413C0 16.6848 1.84783 11.0326 5.54348 6.68478C9.34783 2.22825 14.7283 0 21.6848 0C24.1848 0 26.1413 0.163038 27.5543 0.489121V7.98912C26.0326 7.77173 24.0761 7.66304 21.6848 7.66304C17.9891 7.66304 15 8.91304 12.7174 11.413C10.5435 13.5869 9.29348 16.4674 8.96739 20.0543C10.3804 18.3152 12.663 17.4456 15.8152 17.4456C19.0761 17.4456 21.8478 18.587 24.1304 20.8696C26.413 23.0435 27.5543 25.9239 27.5543 29.5109C27.5543 33.2065 26.3587 36.25 23.9674 38.6413C21.5761 40.9239 18.5326 42.0652 14.837 42.0652ZM47.2826 42.0652C43.4783 42.0652 40.0543 40.5435 37.0109 37.5C33.9674 34.3478 32.4456 29.7283 32.4456 23.6413C32.4456 16.6848 34.2935 11.0326 37.9891 6.68478C41.7935 2.22825 47.1739 0 54.1304 0C56.6304 0 58.587 0.163038 60 0.489121V7.98912C58.4783 7.77173 56.5217 7.66304 54.1304 7.66304C50.4348 7.66304 47.4456 8.91304 45.163 11.413C42.9891 13.5869 41.7391 16.4674 41.413 20.0543C42.8261 18.3152 45.1087 17.4456 48.2609 17.4456C51.5217 17.4456 54.2935 18.587 56.5761 20.8696C58.8587 23.0435 60 25.9239 60 29.5109C60 33.2065 58.8043 36.25 56.413 38.6413C54.0217 40.9239 50.9783 42.0652 47.2826 42.0652Z"
                        fill="#F6B231"
                        />
                    </svg>
                    </div>

                    <div class="text-20 md:text-18 fw-400 mt-60 md:mt-30">
                    <b>Honest and Trustful!</b><br />

                    Marrakech Sweet Travel is a travel agency based in
                    Marrakech with over 16 years of experience in the
                    tourism sector and is officially registered with The
                    Ministry of Tourism. It is our mission to present travel
                    experiences in a respectful fashion that allows
                    travelers to better discover and understand both the
                    past and the future of our treasured land.
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>

        <div class="col-12">
            <div
            class="testimonialsPagination -type-1 pt-60 md:pt-40 testimonialsSlider_1-pagination js-testimonialsSlider_1-pagination"
            >
            <div class="testimonialsPagination__item is-active">
                <img src="img/avatars/1/1.jpg" alt="person" />

                <div class="ml-20">
                <div class="textj-16 lh-14 fw-500">Albert C.</div>
                <div class="text-14 lh-14">Canada</div>
                </div>
            </div>

            <div class="testimonialsPagination__item">
                <img src="img/avatars/1/2.jpg" alt="person" />

                <div class="ml-20">
                <div class="textj-16 lh-14 fw-500">Lina D.</div>
                <div class="text-14 lh-14">Spain</div>
                </div>
            </div>

            <div class="testimonialsPagination__item">
                <img src="img/avatars/1/3.jpg" alt="person" />

                <div class="ml-20">
                <div class="textj-16 lh-14 fw-500">Daniel P.</div>
                <div class="text-14 lh-14">Portugal</div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
</section>

<section class="layout-pt-xl">
    <div data-anim-wrap class="container">
        <div class="row y-gap-30">
        <div class="col-lg-3 col-6">
            <div data-anim-child="fade delay-2" class="text-center">
            <img src="img/icons/3/1.svg" alt="icon" />

            <h3 class="text-40 md:text-30 lh-14 fw-700 mt-30 md:mt-15">
                500+
            </h3>
            <p class="lh-15">Destinations Explored</p>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div data-anim-child="fade delay-3" class="text-center">
            <img src="img/icons/3/2.svg" alt="icon" />

            <h3 class="text-40 md:text-30 lh-14 fw-700 mt-30 md:mt-15">
                10K+
            </h3>
            <p class="lh-15">Guided Tours</p>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div data-anim-child="fade delay-4" class="text-center">
            <img src="img/icons/3/3.svg" alt="icon" />

            <h3 class="text-40 md:text-30 lh-14 fw-700 mt-30 md:mt-15">
                150K+
            </h3>
            <p class="lh-15">Happy Travelers</p>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <div data-anim-child="fade delay-5" class="text-center">
            <img src="img/icons/3/4.svg" alt="icon" />

            <h3 class="text-40 md:text-30 lh-14 fw-700 mt-30 md:mt-15">
                4.9/5
            </h3>
            <p class="lh-15">Customer Rating</p>
            </div>
        </div>
        </div>
    </div>
</section>

<section class="layout-pt-xl layout-pb-xl">
    <div data-anim-wrap class="container">
        <div class="row y-gap-30">
        <div class="col-md-6">
            <div
            data-anim-child="slide-up delay-1"
            class="featureCard -type-3"
            >
            <div class="featureCard__image">
                <img src="img/cta/5/1.jpg" alt="image" />
            </div>

            <div class="featureCard__content">
                <div class="text-white">
                Enjoy these cool staycation promotions in Marrakech
                </div>
                <h4 class="text-30 text-white fw-700 lg:mt-10">
                Best staycation<br />
                deals
                </h4>

                <button class="button -md -accent-1 bg-white">
                See activities
                <i class="icon-arrow-top-right ml-10"></i>
                </button>
            </div>
            </div>
        </div>

        <div class="col-md-6">
            <div
            data-anim-child="slide-up delay-1"
            class="featureCard -type-3"
            >
            <div class="featureCard__image">
                <img src="img/cta/5/2.jpg" alt="image" />
            </div>

            <div class="featureCard__content">
                <div class="text-white">
                Don&#39;t forget to check out these activities while
                you&#39;re here
                </div>
                <h4 class="text-30 text-white fw-700 lg:mt-10">
                All Time Favourite<br />
                Activities in Essaouira
                </h4>

                <button class="button -md -accent-1 bg-white">
                See activities
                <i class="icon-arrow-top-right ml-10"></i>
                </button>
            </div>
            </div>
        </div>
        </div>
    </div>
</section>

<section class="layout-pt-xl layout-pb-xl bg-dark-1">
    <div data-anim-wrap class="container">
        <div
        data-anim-child="slide-up"
        class="row justify-between items-end y-gap-10"
        >
        <div class="col-auto">
            <h2 class="text-30 text-white">
            Marrakech Sweet Travel Blog: Articles, Tips, and Guides
            </h2>
        </div>

        <div class="col-auto">
            <button class="buttonArrow d-flex items-center text-white">
            <span>See all</span>
            <i class="icon-arrow-top-right text-16 ml-10"></i>
            </button>
        </div>
        </div>

        <div
        data-anim-child="slide-up delay-2"
        class="row y-gap-30 pt-40 sm:pt-20"
        >
        <div class="col-lg-4 col-md-6">
            <a href="#" class="blogCard -type-1">
            <div class="blogCard__image ratio ratio-41:30">
                <img
                src="img/blogCards/1/1.png"
                alt="image"
                class="img-ratio rounded-12"
                />
                <div class="blogCard__badge">Trips</div>
            </div>

            <div class="blogCard__content mt-30">
                <div class="blogCard__info text-14 text-white">
                <div class="lh-13">April 06 2025</div>
                <div class="blogCard__line"></div>
                <div class="lh-13">By Osama</div>
                </div>

                <h3 class="blogCard__title text-18 fw-500 text-white mt-10">
                Top 5 Must-See Destinations in Morocco with Marrakech Sweet
                Travel
                </h3>
            </div>
            </a>
        </div>

        <div class="col-lg-4 col-md-6">
            <a href="#" class="blogCard -type-1">
            <div class="blogCard__image ratio ratio-41:30">
                <img
                src="img/blogCards/1/2.png"
                alt="image"
                class="img-ratio rounded-12"
                />
                <div class="blogCard__badge">Trips</div>
            </div>

            <div class="blogCard__content mt-30">
                <div class="blogCard__info text-14 text-white">
                <div class="lh-13">April 06 2025</div>
                <div class="blogCard__line"></div>
                <div class="lh-13">By Osama</div>
                </div>

                <h3 class="blogCard__title text-18 fw-500 text-white mt-10">
                Planning Your Perfect Moroccan Adventure: Tips from
                Marrakech Sweet Travel
                </h3>
            </div>
            </a>
        </div>

        <div class="col-lg-4 col-md-6">
            <a href="#" class="blogCard -type-1">
            <div class="blogCard__image ratio ratio-41:30">
                <img
                src="img/blogCards/1/3.png"
                alt="image"
                class="img-ratio rounded-12"
                />
                <div class="blogCard__badge">Trips</div>
            </div>

            <div class="blogCard__content mt-30">
                <div class="blogCard__info text-14 text-white">
                <div class="lh-13">April 06 2025</div>
                <div class="blogCard__line"></div>
                <div class="lh-13">By Osama</div>
                </div>

                <h3 class="blogCard__title text-18 fw-500 text-white mt-10">
                Why a Guided Tour with Marrakech Sweet Travel is the Best
                Way to Discover Morocco
                </h3>
            </div>
            </a>
        </div>
        </div>
    </div>
</section>

<section data-anim="slide-up" class="layout-pt-xl layout-pb-xl relative">
    <div class="sectionBg">
        <img src="img/cta/4/1.png" alt="image" class="img-cover" />
    </div>

    <div class="container">
        <div class="row">
        <div class="col-lg-5">
            <h2 class="text-30 text-white fw-700">
            Subscribe to Our Travel Newsletter
            <br class="md:d-none" />
            And Stay Updated!
            </h2>
            <p class="text-white mt-30">
            Sign up to receive exclusive travel tips, destination
            highlights, and the latest offers from Marrakech Sweet Travel.
            </p>

            <div class="singleInput type-1 mt-30">
            <input type="text" placeholder="Your email" />
            <button class="button -md -dark-1 bg-white">Subscribe</button>
            </div>
        </div>
        </div>
    </div>
</section>

@endsection
