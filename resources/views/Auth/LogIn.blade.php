<!DOCTYPE html>
<html>
@include('Include.header')
<div class="container-fluid">

    <div class="my-form card ms-auto me-auto">
        <form method="POST" action="Login">
            @csrf
            <div class="form-group mt-2">
                <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email-input" placeholder="Email">
                @error('email')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
            <div class="form-group mt-2">
                <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password-input" placeholder="Password" autocomplete="on">
                @error('password')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
            <div class="form-group mt-2" align="center">

                <button type="submit" class="btn my-btn">log in</button>

            </div>
        </form>

        <hr style="background-color: #7a7d81">
        <div align="center">
            <a class="ml-1" href="signup">sign up here</a>
        </div>
        @include('Include.footer')
</div>
</div>
</body>
</html>
<script>

</script>
