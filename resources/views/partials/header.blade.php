<header class="header -type-3 js-header">
    <div data-anim="fade delay-3" class="header__container container">
        <div class="headerMobile__left">
            <button class="header__menuBtn js-menu-button">
                <i class="icon-main-menu"></i>
            </button>
        </div>

        <div class="header__logo">
            <a href="index.html" class="header__logo">
                <img src="img/general/logo.svg" alt="logo icon" />
            </a>
        </div>

        <div class="xl:d-none ml-30">
            <div class="desktopNav">
                <div class="desktopNav__item">
                    <a href="/">Home</a>
                </div>

                <div class="desktopNav__item">
                    <a href="#">Day Trip <i class="icon-chevron-down"></i></a>
                    <div class="desktopNavSubnav">
                        <div class="desktopNavSubnav__content">
                            <div class="desktopNavSubnav__item">
                                <a href="/day-trip-from-marrakech">Departure From Marrakech</a>
                            </div>
                            <div class="desktopNavSubnav__item">
                                <a href="/day-trip-from-casablanca">Departure From Casablanca</a>
                            </div>
                            <div class="desktopNavSubnav__item">
                                <a href="/day-trip-from-fes">Departure From Fes</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="desktopNav__item">
                    <a href="#">Activities <i class="icon-chevron-down"></i></a>
                    <div class="desktopNavSubnav">
                        <div class="desktopNavSubnav__content">
                            <div class="desktopNavSubnav__item">
                                <a href="/activities-in-marrakech">Marrakech</a>
                            </div>
                            <div class="desktopNavSubnav__item">
                                <a href="/activities-in-agafay-desert">Agafay Desert</a>
                            </div>
                            <div class="desktopNavSubnav__item">
                                <a href="/activities-in-agadir">Agadir</a>
                            </div>
                            <div class="desktopNavSubnav__item">
                                <a href="/activities-in-essaouira">Essaouira</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="desktopNav__item">
                    <a href="#">Tours <i class="icon-chevron-down"></i></a>
                    <div class="desktopNavSubnav">
                        <div class="desktopNavSubnav__content">
                            <!-- Shared Group -->
                            <div class="desktopNavSubnav__item">
                                <a href="#">Shared Group <i class="icon-chevron-right"></i></a>
                                <div class="desktopNavSubnav">
                                    <div class="desktopNavSubnav__content">
                                        <div class="desktopNavSubnav__item">
                                            <a href="/3-days-desert-tour-from-marrakech-to-merzouga">3 Days Desert Tour From Marrakech To Merzouga</a>
                                        </div>
                                        <div class="desktopNavSubnav__item">
                                            <a href="/2-days-desert-tour-to-zagora-from-marrakech">2 Days Desert Tour To Zagora From Marrakech</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Departure Locations -->
                            <div class="desktopNavSubnav__item">
                                <a href="/tours-from-marrakech">Departure From Marrakech</a>
                            </div>
                            <div class="desktopNavSubnav__item">
                                <a href="/tours-from-casablanca">Departure From Casablanca</a>
                            </div>
                            <div class="desktopNavSubnav__item">
                                <a href="/tours-from-tanger">Departure From Tanger</a>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="desktopNav__item">
                    <a href="/transfers">Transfers</a>
                </div>

                <div class="desktopNav__item">
                    <a href="/contact-us">Contact Us</a>
                </div>

                <div class="desktopNav__item">
                    <a href="/about-us">About Us</a>
                </div>
            </div>
        </div>

        <div class="headerMobile__right">
            <button class="d-flex">
                <i class="icon-search text-18"></i>
            </button>

            <button class="d-flex ml-20">
                <i class="icon-person text-18"></i>
            </button>
        </div>


     <div class="header__right">

    <div class="headerDropdown ml-30 js-form-dd">
        <!-- Dropdown button -->
        <div id="dropdownButton" style="cursor: pointer; display: inline-block;" class="headerDropdown__button" data-x-click="header-currency">
            {{ session('currency', 'USD') }} <!-- Dynamically show the selected currency -->
            <i class="icon-chevron-down text-18"></i>
        </div>

        <!-- Dropdown content -->
        <div id="dropdownContent" style="display: none; position: absolute;" class="headerDropdown__content" data-x="header-currency" data-x-toggle="is-active">
            <div class="headerDropdown">
                <div class="headerDropdown__container">
                    <!-- Dropdown items -->
                    @foreach (['USD', 'EUR', 'GBP'] as $currency)
                        <div class="headerDropdown__item">
                            <button data-currency="{{ $currency }}">{{ $currency }}</button>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const dropdownButton = document.getElementById('dropdownButton');
            const dropdownContent = document.getElementById('dropdownContent');

            // Toggle dropdown visibility
            dropdownButton.addEventListener('click', function () {
                const isVisible = dropdownContent.style.display === 'block';
                dropdownContent.style.display = isVisible ? 'none' : 'block';
            });

            // Handle currency selection
            dropdownContent.addEventListener('click', function (event) {
                if (event.target.tagName === 'BUTTON') {
                    const selectedCurrency = event.target.getAttribute('data-currency');
                    fetch(`/set-currency?currency=${selectedCurrency}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Update the dropdown button text
                                dropdownButton.firstChild.textContent = selectedCurrency;
                                location.reload(); // Reload the page to update prices
                            } else {
                                alert('Failed to update currency. Please try again.');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('An error occurred while updating the currency.');
                        });
                    dropdownContent.style.display = 'none'; // Close dropdown
                }
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function (event) {
                if (!dropdownButton.contains(event.target) && !dropdownContent.contains(event.target)) {
                    dropdownContent.style.display = 'none';
                }
            });
        });
    </script>
</div>


    </div>
</header>

<div class="menu js-menu">
    <div class="menu__overlay js-menu-button"></div>

    <div class="menu__container">
        <div class="menu__header">
            <h4>Main Menu</h4>
            <button class="js-menu-button">
                <i class="icon-cross text-10"></i>
            </button>
        </div>

        <div class="menu__content">
            <ul class="menuNav js-navList">
                <li class="menuNav__item">
                    <a href="/">Home</a>
                </li>
                <li class="menuNav__item -has-submenu js-has-submenu">
                    <a>Day Trip <i class="icon-chevron-right"></i></a>
                    <ul class="submenu">
                        <li class="submenu__item">
                            <a href="/day-trip-from-marrakech">Departure From Marrakech</a>
                        </li>
                        <li class="submenu__item">
                            <a href="/day-trip-from-casablanca">Departure From Casablanca</a>
                        </li>
                        <li class="submenu__item">
                            <a href="/day-trip-from-fes">Departure From Fes</a>
                        </li>
                    </ul>
                </li>
                <li class="menuNav__item -has-submenu js-has-submenu">
                    <a>Activities <i class="icon-chevron-right"></i></a>
                    <ul class="submenu">
                        <li class="submenu__item">
                            <a href="/activities-in-marrakech">Marrakech</a>
                        </li>
                        <li class="submenu__item">
                            <a href="/activities-in-agafay-desert">Agafay Desert</a>
                        </li>
                        <li class="submenu__item">
                            <a href="/activities-in-agadir">Agadir</a>
                        </li>
                        <li class="submenu__item">
                            <a href="/activities-in-essaouira">Essaouira</a>
                        </li>
                    </ul>
                </li>
                <li class="menuNav__item -has-submenu js-has-submenu">
                    <a>Tours <i class="icon-chevron-right"></i></a>
                    <ul class="submenu">
                        <li class="submenu__item -has-submenu js-has-submenu">
                            <a>Shared Group <i class="icon-chevron-right"></i></a>
                            <ul class="submenu">
                                <li class="submenu__item">
                                    <a href="/3-days-desert-tour-from-marrakech-to-merzouga">3 Days Desert Tour From Marrakech To Merzouga</a>
                                </li>
                                <li class="submenu__item">
                                    <a href="/2-days-desert-tour-to-zagora-from-marrakech">2 Days Desert Tour To Zagora From Marrakech</a>
                                </li>
                            </ul>
                        </li>
                        <li class="submenu__item">
                            <a href="/tours-from-marrakech">Departure From Marrakech</a>
                        </li>
                        <li class="submenu__item">
                            <a href="/tours-from-casablanca">Departure From Casablanca</a>
                        </li>
                        <li class="submenu__item">
                            <a href="/tours-from-tanger">Departure From Tanger</a>
                        </li>
                    </ul>
                </li>


                <li class="menuNav__item">
                    <a href="/transfers">Transfers</a>
                </li>
                <li class="menuNav__item">
                    <a href="/contact-us">Contact Us</a>
                </li>
                <li class="menuNav__item">
                    <a href="/about-us">About Us</a>
                </li>
            </ul>
        </div>

        <div class="menu__footer">
            <i class="icon-headphone text-50"></i>

            <div class="text-20 lh-12 fw-500 mt-20">
                <div>Speak to our agent at</div>
                <div class="text-accent-1">+212 524 390 367</div>
            </div>

            <div class="d-flex items-center x-gap-10 pt-30">
                <div>
                    <a class="d-block">
                        <i class="icon-facebook"></i>
                    </a>
                </div>
                <div>
                    <a class="d-block">
                        <i class="icon-twitter"></i>
                    </a>
                </div>
                <div>
                    <a class="d-block">
                        <i class="icon-instagram"></i>
                    </a>
                </div>
                <div>
                    <a class="d-block">
                        <i class="icon-linkedin"></i>
                    </a>
        </div>
    </div>
    </div>
</div>
</div>

