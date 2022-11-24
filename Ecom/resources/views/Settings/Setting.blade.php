@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success" id="successMessage" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ route('update.setting') }}" method="POST">
            @csrf
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="register"
                    <?php if ($settings['register'] == 1) {
                        echo 'checked';
                    } ?>>
                <label class="form-check-label text-bold" for="flexSwitchCheckDefault">Receive Mails on New User
                    Registration</label>
            </div>

            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="order"
                    <?php if ($settings['order'] == 1) {
                        echo 'checked';
                    } ?>>
                <label class="form-check-label text-bold" for="flexSwitchCheckChecked">Receive Mails on New Order
                    Placed</label>
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-primary">
                    {{ __('Update') }}
                </button>
            </div>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        setTimeout(function() {
            $('#successMessage').fadeOut('fast');
        }, 3000);
    </script>
@endsection
