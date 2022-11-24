@if ($message = Session::get('success'))
</br>
<div class="alert alert-success alert-dismissible fade show" role="alert">

  <strong>{{ $message }}</strong>

  {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}

</div>

@endif 

    

@if ($message = Session::get('error'))
</br>
<div class="alert alert-danger alert-dismissible fade show" role="alert">

  <strong>{{ $message }}</strong>

  {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}

</div>

@endif

     

@if ($message = Session::get('warning'))
</br>
<div class="alert alert-warning alert-dismissible fade show" role="alert">

  <strong>{{ $message }}</strong>

  {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}

</div>

@endif

     

@if ($message = Session::get('info'))
</br>
<div class="alert alert-info alert-dismissible fade show" role="alert">

  <strong>{{ $message }}</strong>

</div>

@endif

    

@if ($errors->any())

<div class="alert alert-danger alert-dismissible fade show" role="alert">
<strong>Please check below for errors</strong>
</div>
@foreach($errors->all() as $error_msg )
            <span class='text-danger'>* {{$error_msg}}</span></br>
@endforeach

@endif