<!DOCTYPE html>
<html>
@include('Include.header')
<!-- Modal -->
<div class="modal fade" id="TaskModal" tabindex="-1" aria-labelledby="TaskModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TaskModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="TaskModalBody">
                <div class="form-floating">
                    <input type="text" class="form-control" name="name" placeholder="Project name" aria-label="First name">
                    <label for="floatingTextarea">Project name</label>
                </div>
                <div class="form-floating mt-2">
                    <input class="form-control" placeholder="date" name="deadline" type="date" id="deadline" >
                    <label for="floatingTextarea">Deadline</label>
                </div>
                <div class="form-floating mt-2">
                    <textarea id="taskContent" type="text" name="description" class="form-control" placeholder="Task description" aria-label="Task description" style="height: 200px" ></textarea>
                    <label for="floatingTextarea">Task description</label>
                </div>
            </div>
            <div class="ms-2" id="TaskModalBy"></div>
            <div class="modal-footer">
                <button type="button" class="btn my-btn" onclick="event.preventDefault(); AssignEmployee();">Assign Task</button>
                <button type="button"  class="btn btn-secondary" data-bs-dismiss="modal" id="closeModal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="assignModal" tabindex="-1" aria-labelledby="assignModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="assignModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="assignModalBody">
                <div class="form-floating">
                    <textarea id="taskContent" type="text" name="description" class="form-control" placeholder="Task description" aria-label="Task description" style="height: 300px" ></textarea>
                    <label for="floatingTextarea">Project description</label>
                </div>
            </div>
            <div class="ms-2" id="assignModalBy"></div>
            <div class="modal-footer">
                <button type="button" class="btn my-btn" onclick="event.preventDefault(); AssignEmployee();">Assign Task</button>
                <button type="button"  class="btn btn-secondary" data-bs-dismiss="modal" id="closeModal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <form class="mt-4" action="creat_project" method="post">
        @csrf
        <div class="row">
            <div class="col-3">
                <div class="form-floating">
                    <input type="text" class="form-control" name="name" placeholder="Project name" aria-label="First name" value="{{$project['name']}}">
                    <label for="floatingTextarea">Project name</label>
                </div>
                <div class="form-floating mt-2">
                    <input class="form-control" placeholder="date" name="deadline" type="date" id="deadline" value="{{$project['deadline']}}">
                    <label for="floatingTextarea">Deadline</label>
                </div>
                <button type="button" class="btn my-btn" data-bs-toggle="modal" data-bs-target="#TaskModal">
                    Create task
                </button>
                <div class="list-group mt-3" id="employeeList">
                    <label>Employees List</label>
                    @foreach($employees as $employee)
                        <a href="#" onclick="event.preventDefault(); ViewAssignEmployee({{json_encode($employee)}})" class="list-group-item list-group-item-action" data-bs-toggle="modal" data-bs-target="#assignModal">{{$employee->name}}</a>
                    @endforeach
                </div>

            </div>
            <div class="col">
                <div class="form-floating">
                    <textarea type="text" name="description" class="form-control" placeholder="Project description" aria-label="Project description" style="height: 300px" >{{$project['description']}}</textarea>
                    <label for="floatingTextarea">Project description</label>
                </div>
                <button class="btn my-btn mt-2" style="width: 8rem;">Update</button>
            </div>
        </div>
    </form>

    @include('Include.footer')
</div>
</body>
</html>
<script>
    let assignedEmployees=[];
    let selectedEmployee;
function ViewAssignEmployee(employee)
{
    selectedEmployee=employee;
    document.getElementById('assignModalLabel').innerHTML="Employee name: "+employee.name;
}

function AssignEmployee()
{
    let content=document.getElementById('taskContent').value;
    assignedEmployees.push({"employeeId":selectedEmployee.id, "taskContent":content});
    console.log(assignedEmployees);
    document.getElementById('notification message').innerText="Task Assigned Successfully When you hit update it all will be saved";
    document.getElementById('alert-pop').classList.add('show');
    document.getElementById('closeModal').click();
}
</script>
