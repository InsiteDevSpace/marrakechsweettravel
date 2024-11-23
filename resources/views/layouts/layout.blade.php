<!DOCTYPE html>
<html lang="en" data-x="html" data-x-toggle="html-overflow-hidden">
  <head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/" />
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&amp;display=swap"
      rel="stylesheet"
    />


    <link rel="icon" type="image/png" href="favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    <link rel="shortcut icon" href="favicon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png" />
    <link rel="manifest" href="favicon/site.webmanifest" />

    <!-- Stylesheets -->
    <link rel="stylesheet" href="css/vendors.css" />
    <link rel="stylesheet" href="css/main.css" />

    <title>Marrakechsweettravel</title>
  </head>

  <body>
    <div
      class="tourPagesSidebar"
      data-x="tourPagesSidebar"
      data-x-toggle="-is-active"
    >
      <div class="tourPagesSidebar__overlay"></div>
      <div class="tourPagesSidebar__content">
        <div
          class="tourPagesSidebar__header d-flex items-center justify-between"
        >
          <div class="text-20 fw-500">All filters</div>

          <button
            class="button -dark-1 size-40 rounded-full bg-light-1"
            data-x-click="tourPagesSidebar"
          >
            <i class="icon-cross text-10"></i>
          </button>
        </div>
      </div>
    </div>

    <button class="toTopButton js-top-button">
      <svg
        width="22"
        height="22"
        viewBox="0 0 22 22"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
      >
        <g clip-path="url(#clip0_83_4004)">
          <path
            d="M17.8783 0H4.12177C3.59388 0 3.16602 0.42786 3.16602 0.955755C3.16602 1.48365 3.59388 1.91151 4.12177 1.91151H17.8783C18.4062 1.91151 18.834 1.48365 18.834 0.955755C18.834 0.42786 18.4062 0 17.8783 0Z"
          />
          <path
            d="M11.6759 4.67546C11.3026 4.30219 10.6975 4.30219 10.3242 4.67546L6.04107 8.95863C5.66779 9.3319 5.66779 9.937 6.04107 10.3103C6.41434 10.6837 7.01955 10.6836 7.39272 10.3103L10.0444 7.6587V21.0443C10.0444 21.5722 10.4723 22 11.0002 22C11.5281 22 11.9559 21.5722 11.9559 21.0443V7.65859L14.6076 10.3102C14.7942 10.4969 15.0389 10.5901 15.2834 10.5901C15.528 10.5901 15.7726 10.4968 15.9593 10.3102C16.3325 9.9369 16.3325 9.3318 15.9593 8.95852L11.6759 4.67546Z"
          />
        </g>
        <defs>
          <clipPath id="clip0_83_4004">
            <rect width="22" height="22" fill="white" />
          </clipPath>
        </defs>
      </svg>
    </button>

    <main>


      @include('partials.header')

      @yield('content')

      @include('partials.footer')
    </main>

    <!-- JavaScript -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAz77U5XQuEME6TpftaMdX0bBelQxXRlM"></script>
    <script src="../../../unpkg.com/%40googlemaps/markerclusterer%402.5.3/dist/index.min.js"></script>

    <script src="js/vendors.js"></script>
    <script src="js/main.js"></script>
  </body>

</html>
