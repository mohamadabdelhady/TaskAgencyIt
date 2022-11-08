<!DOCTYPE html>
<html>
@include('Include.header')

<div class="container-fluid p-0">
    <div class="my-form card ms-auto me-auto">
        <form method="POST" action="register">
            @csrf
            <div class="form-group mt-2">
                <input name="name" class="form-control @error('name') is-invalid @enderror" id="uname-input" placeholder="Name">
                @error('name')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
            <div class="form-group mt-2">
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email-input" placeholder="Email" name="email">
                @error('email')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
            <div class="form-group mt-2">
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password-input" placeholder="Password" autocomplete="on">
                @error('password')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
            <div class="form-group mt-2">
                <input type="password" class="form-control" id="confirm-password-input" placeholder="Confirm password" name="password_confirmation" autocomplete="on">
            </div>
            <div class="form-check mt-2">
                <input class="form-check-input" type="radio" name="role" id="Supervisor" value="1">
                <label class="form-check-label" for="Supervisor">
                    Supervisor
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="role" id="Employee" value="0" checked>
                <label class="form-check-label" for="Employee">
                    Employee
                </label>
            </div>
            <div class="form-group mt-2" align="center">

                <button type="submit" class="btn my-btn">Sign up</button>

            </div>

        </form>

        <hr style="background-color: #7a7d81">
        <div align="center">
            <a href="login">Log in here</a>
        </div>
    </div>
    @include('Include.footer')
</div>


</body>
</html>
<script>

</script>
