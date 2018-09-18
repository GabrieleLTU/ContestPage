@if(count($errors)>0)
    @foreach($errors->all() as $error)
        <div class="alrt alert-danger">
            {{$error}}
        </div>
    @endforeach
@endif

@if(session('success'))
    <div class="alrt alert-success">
        {{session('success')}}
    </div>
@endif

@if(session('error'))
    <div class="alrt alert-danger">
        {{session('error')}}
    </div>
@endif

