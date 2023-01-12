<form action="{{ route('login') }}" class="login_form" method="post">
    @csrf
    <div class="form-floating mb-3">
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" value="{{ old('email') }}">
        <label for="email">E-mail cím</label>

        @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="form-floating mb-3">
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password">
        <label for="password">Jelszó</label>

        @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="text-center">
        <button type="submit" id="loginBtn" class="btn btn-primary animate__animated animate__bounceIn">Belépés</button>
    </div>
</form>