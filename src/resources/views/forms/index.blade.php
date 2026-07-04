<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ __('forms.forms.title') }}</title>
    @vite(['resources/css/app.css', 'resources/css/forms/style.css', 'resources/js/app.js', 'resources/js/forms/main.js'])
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100 color-container">
    <div class="container-fluid">
        <div class="list-form mt-5">
        <h1 class="form-title">{{ __('forms.forms.title') }}</h1>

        <form id="form-city" method="POST" action="{{ route('forms.store') }}" enctype="multipart/form-data" novalidate>
            @csrf
            <div class="container">
                <div id="form-validation-alert" class="alert alert-danger d-none" role="alert">
                    {{ __('forms.validation.alert') }}
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="city_id" class="form-label">{{ __('forms.forms.select-city') }}</label>
                        <select class="form-select" id="city_id" name="city_id">
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="latitude" class="form-label">{{ __('forms.forms.latitude') }}</label>
                        <input type="text" class="form-control decimal-input" id="latitude" name="latitude" inputmode="decimal" required pattern="^-?\d+([.,]\d{1,7})?$" min="-90" max="90" step="0.0000001" placeholder="{{ __('forms.forms.latitude') }}" data-required-message="{{ __('forms.validation.latitude_required') }}" data-decimal-message="{{ __('forms.validation.latitude_decimal') }}" data-range-message="{{ __('forms.validation.latitude_range') }}">
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <label for="length" class="form-label">{{ __('forms.forms.length') }}</label>
                        <input type="text" class="form-control decimal-input" id="length" name="length" inputmode="decimal" required pattern="^-?\d+([.,]\d{1,7})?$" min="-180" max="180" step="0.0000001" placeholder="{{ __('forms.forms.length') }}" data-required-message="{{ __('forms.validation.length_required') }}" data-decimal-message="{{ __('forms.validation.length_decimal') }}" data-range-message="{{ __('forms.validation.length_range') }}">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-md-6">
                        <label for="image" class="form-label">{{ __('forms.forms.image') }}</label>
                        <input type="file" class="form-control" name="image">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <button class="btn btn-outline-success" type="submit">{{ __('global.buttons.save') }}</button>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div> 
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const successMessage = @json(session('success'));
            const errorMessages = @json($errors->all());

            if (successMessage && window.Swal) {
                Swal.fire({
                    icon: 'success',
                    title: @json(__('forms.alerts.success_title')),
                    text: successMessage,
                    confirmButtonText: @json(__('forms.alerts.confirm')),
                });
            }

            if (errorMessages.length > 0 && window.Swal) {
                Swal.fire({
                    icon: 'error',
                    title: @json(__('forms.alerts.error_title')),
                    text: errorMessages.join('\n'),
                    confirmButtonText: @json(__('forms.alerts.confirm')),
                });
            }
        });
    </script>
</body>
</html>
