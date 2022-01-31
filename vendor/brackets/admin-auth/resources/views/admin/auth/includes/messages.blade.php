@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            @if ($error=='These credentials do not match our records.')     
                <li>Estas credenciales no coinciden con nuestros registros.</li>          
            @endif
            @if ($error!='These credentials do not match our records.')     
                <li>{{ $error }}</li>          
            @endif    
            @endforeach
        </ul>
    </div>
@endif