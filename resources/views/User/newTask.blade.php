<!DOCTYPE html>
<html>
@include('Include.header')
<div class="container">
    <h2 class="mt-2"> new task for: {{$projectName->name}}</h2>
    <form class="mt-4" onsubmit="event.preventDefault(); saveTask();">
        @csrf
        <div class="row">
            <div class="col-3">
                <div class="form-floating">
                    <input type="text" class="form-control" name="name" placeholder="Project name" id="name" aria-label="First name">
                    <label for="floatingTextarea">Task name</label>
                </div>
                <div class="form-floating mt-2">
                    <input class="form-control" placeholder="date" name="deadline" id="date" type="date" id="deadline">
                    <label for="floatingTextarea">Deadline</label>
                </div>
            </div>
            <div class="col">
                <div class="form-floating">
                    <textarea type="text" id="description" name="description" class="form-control" placeholder="Task description" aria-label="Task description" style="height: 300px" ></textarea>
                    <label for="floatingTextarea">Task description</label>
                </div>
                <button class="btn my-btn mt-2" style="width: 8rem;">
                    <span id="action">Create</span>
                    <span id="action-loader" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display:none;"></span>
                </button>
            </div>
        </div>
    </form>
    @include('Include.footer')
</div>
</body>
</html>
<script>
function saveTask() {
    let taskName=document.getElementById('name').value;
    let taskDescription=document.getElementById('description').value;
    let taskDeadline=document.getElementById('date').value;
    let taskProjectId={{$id}};

    document.getElementById('action').style.display="none";
    document.getElementById('action-loader').style.display="block";
    axios.post('/createTask', {
        ProjectId: taskProjectId,
        name: taskName,
        description: taskDescription,
        deadline: taskDeadline
    }).then(response => {

        document.getElementById('notification message').innerText=response.data;
        document.getElementById('alert-pop').classList.add('show');

        document.getElementById('name').value="";
        document.getElementById('date').value="";
        document.getElementById('description').value="";

        document.getElementById('action').style.display="block";
        document.getElementById('action-loader').style.display="none";
    }).catch(()=> {
        document.getElementById('alert-pop').classList.add('show');
        document.getElementById('notification message').innerText ="Something went wrong and we couldn't execute your request";
    });
}
</script>
