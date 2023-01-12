<form action="{{ route('register.store') }}" method="post">
    @csrf
    <div class="alertBox alert alert-dismissible fade show"></div>
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
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Teszt Elek" value="{{ old('name') }}">
        <label for="name">Név</label>

        @error('name')
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
    <div class="form-floating mb-3">
        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Password">
        <label for="password_confirmation">Jelszó megerősítése</label>
    </div>
    <div class="text-center">
        <button type="submit" id="registerBtn" class="btn btn-primary animate__animated animate__bounceIn">Regisztráció</button>
    </div>
</form>