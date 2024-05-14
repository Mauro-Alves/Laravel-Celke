@if (session('success'))
    <p style="color: green">
        {{ session('success') }}
    </p>
@endif

@if (session('error'))
    <p style="color: #f00">
        {{ session('error') }}
    </p>
@endif

@if ($errors->any())
    <span style="color: #f00">
        @foreach ($errors->all() as $error)
            {{ $error }}<br>
        @endforeach
    </span>
@endif
