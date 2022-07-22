<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
  {{-- Tailwind Css --}}
  <script src="https://cdn.tailwindcss.com"></script>
  {{-- Fontawesome --}}
  <script src="https://kit.fontawesome.com/e4fdbc0c51.js" crossorigin="anonymous"></script>
  <link href="{{ mix('/css/app.css') }}" rel="stylesheet" />
  <script src="{{ mix('js/manifest.js') }}" defer></script>
  <script src="{{ mix('js/vendor.js') }}" defer></script>
  <script src="{{ mix('/js/app.js') }}" defer></script>
</head>

<body class="bg-gray-100">
  @inertia
</body>

</html>
