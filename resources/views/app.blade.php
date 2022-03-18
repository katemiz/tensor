<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    {{-- <link rel="icon" type="image/svg+xml" href="/images/{{ config('constants.COMPANY.LOGO'); }}" /> --}}

    {{-- <link rel="icon" type="image/svg+xml" href="/images/tensor_favicon.svg" /> --}}

    <link rel="icon" type="image/svg+xml" href="{{ config('constants.favicon') }}" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />
    <link href="{{ mix('/css/bulma.css') }}" rel="stylesheet" />
    <script src="{{ mix('/js/manifest.js') }}" defer></script>
    <script src="{{ mix('/js/vendor.js') }}" defer></script>
    <script src="{{ mix('/js/app.js') }}" defer></script>
    @inertiaHead
  </head>
  <body>
    @inertia
  </body>
</html>

