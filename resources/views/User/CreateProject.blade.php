<!DOCTYPE html>
<html>
@include('Include.header')
<div class="container">

        <form class="mt-4" action="creat_project" method="post">
            @csrf
            <div class="row">
                <div class="col-3">
                    <div class="form-floating">
                    <input type="text" class="form-control" name="name" placeholder="Project name" aria-label="First name">
                    <label for="floatingTextarea">Project name</label>
                </div>
                    <div class="form-floating mt-2">
                        <input class="form-control" placeholder="date" name="deadline" type="date" id="deadline">
                        <label for="floatingTextarea">Deadline</label>
                    </div>

                </div>
                <div class="col">
                    <div class="form-floating">
                    <textarea type="text" name="description" class="form-control" placeholder="Project description" aria-label="Project description" style="height: 300px"></textarea>
                    <label for="floatingTextarea">Project description</label>
                    </div>
                    <button class="btn my-btn mt-2" style="width: 8rem;">Create</button>
                </div>
            </div>

        </form>
    @include('Include.footer')
</div>
</body>
</html>
<script>

</script>
