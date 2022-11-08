<!DOCTYPE html>
<html>
@include('Include.header')
<div class="container">
@if(auth()->user()->is_admin)
    @include('User.AdminBoard')
    @else
    @include('User.EmployeeBoard')
    @endif
        @include('Include.footer')
</div>
</body>
</html>
<script>

</script>
