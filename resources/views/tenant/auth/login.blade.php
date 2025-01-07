<!-- resources/views/tenant/register.blade.php -->
<html>
    <head>
        <title>Tenant Login</title>
    </head>
    <body>
        @if($errors->any())
@foreach ($errors->all() as $error )
<div>{{ $error }} </div>
@endforeach
        @endif
        <h1>Tenant Registration</h1>

        <form method="POST" action="{{ route('tenant.login.store') }}">
            @csrf


            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Enter your email" required/> </br>


            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Enter your password" required/> </br>

            <button type="submit">Login</button>
        </form>

    </body>
</html>
