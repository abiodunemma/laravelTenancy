<!-- resources/views/tenant/register.blade.php -->
<html>
    <head>
        <title>Tenant Register</title>
    </head>
    <body>
        @if($errors->any())
@foreach ($errors->all() as $error )
<div>{{ $error }} </div>
@endforeach
        @endif
        <h1>Tenant Registration</h1>

        <form method="POST" action="{{ route('tenant.register.store') }}">
            @csrf


            <label for="name">Name</label>
            <input type="text" name="name" id="name" placeholder="Enter your name" required/> </br>


            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Enter your email" required/> </br>


            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Enter your password" required/> </br>


            <label for="password_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm your password" required/> </br>

            <button type="submit">Register</button>
        </form>

    </body>
</html>
