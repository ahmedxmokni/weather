<!-- resources/views/home.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Country Selection</title>

    <!-- Include Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center mb-4">Select Your Country</h1>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Form for country selection -->
    <form id="weatherForm">
        @csrf
        <div class="form-group">
            <label for="country">Country</label>
            <select id="country" name="country" class="form-control">
                @foreach(['Tunisie', 'Nabeul', 'Kairouan', 'Monastir', 'Sousse', 'Mahdia', 'Sfax', 'Gabes', 'Gafsa', 'Sidi Bouzid', 'Kasserine', 'Jandouba', 'Béja', 'Bizerte','Ain el Bidha','Moknine'] as $country)
                    <option value="{{ $country }}">{{ $country }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Get weather</button>
    </form>

    <!-- Section to display weather data -->
    <div id="weatherData" class="mt-5"></div>
</div>

<!-- Include jQuery, Popper.js, and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function() {
        // Intercept the form submission and handle it with AJAX
        $('#weatherForm').on('submit', function(e) {
            e.preventDefault();  // Prevent normal form submission

            var country = $('#country').val();  // Get selected country
            var _token = $("input[name='_token']").val();  // CSRF token

            // Make AJAX request to get weather data
            $.ajax({
                url: "{{ route('get.weather') }}",
                method: "POST",
                data: {
                    country: country,
                    _token: _token
                },
                success: function(response) {
                    // Display weather data in the #weatherData div
                    $('#weatherData').html(response);
                },
                error: function(xhr, status, error) {
                    // Handle errors here
                    $('#weatherData').html('<div class="alert alert-danger">Le pays selectionné est invalide ou non trouvé</div>');
                }
            });
        });
    });
</script>

</body>
</html>
