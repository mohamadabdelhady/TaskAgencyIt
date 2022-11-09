<!DOCTYPE html>
<html>
@include('Include.header')
<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="viewModalBody">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="assignModal" tabindex="-1" aria-labelledby="assignModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="assignModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="assignModalBody">
                <div id="all-employees"></div>
            </div>
            <div class="modal-footer">
                <button class="btn my-btn mt-2" style="width: 8rem;" onclick="assignEmployee()">
                    <span id="action">Save Assignments</span>
                    <span id="action-loader" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display:none;"></span>
                </button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="closeModal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <h2 class="mt-2">task of : {{$projectName->name}}</h2>
    <div class="row">
        <div class="col-12">


            <div class="" id="all-tasks">

            </div>
            <h2 id="no-task" align="center" class="mt-5"></h2>
            <div class="Loader mt-2" id="load">
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
    </div>
    @include('Include.footer')
</div>
</div>
</body>
</html>
<script>
    let tasks=[];
    let count=0;
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('load').style.display="block";
        axios.get('/getTasks')
            .then(response => {
                $.each(response.data, (key, v) => {
                    tasks.push(v);
                });

                tasks.forEach((task,index)=>{
                    count++;
                    let card=`<span class="card me-1 ms-1 d-inline-flex mt-1" style="width: 20rem;">
                <div class="card-body">
                    <h5 class="card-title">${task.name}</h5>
                    <p class="card-text">${abbreviate(task.description,task.id)} <span id="read-more"></span></p>
                    <div>
                        <a href="" class="me-2" onclick="event.preventDefault(); viewtask(${task.id})" data-bs-toggle="modal" data-bs-target="#viewModal">view</a>
                        <a href="/updateTask/${task.id}" class="me-2" >Update</a>
                        <a href="AssignTask/${task.id}" class="me-2" onclick="event.preventDefault(); loadEmployees(${task.id},${task.projectId})" data-bs-toggle="modal" data-bs-target="#assignModal">assign Employee</a>
                        <a href="/deleteTask/${task.id}" style="color: darkred!important;" class="float-end">Delete</a>
                    </div>
                </div>
            </span>`
                    let area = document.getElementById('all-tasks');
                    area.innerHTML+=card;
                })
            });
        document.getElementById('load').style.display="none";
        if(count=0)
        {
            let area = document.getElementById('no-task');
            area.innerHTML='There is currently no tasks.';
        }

    });

    function abbreviate(text,id)
    {
        let count=text.length;

        if(count>150) {
            console.count(count);
            text = text.slice(0,250);
            text+=" .....";
            text+=" .....(click view to read more)";
        }
        return text;
    }

    function viewtask(id)
    {
        let selectedCard=tasks.find(element=>element.id==id);
        document.getElementById('viewModalLabel').innerHTML=selectedCard.name;
        document.getElementById('viewModalBody').innerHTML=selectedCard.description;
    }


    let employees = [];
    let selectedTaskId;
    let projectId;
    function loadEmployees(id,projectid) {
        selectedTaskId=id;
        projectId=projectid;
        employees=[];
        let assigned;
        let area = document.getElementById('all-employees');
        area.innerHTML="";
        axios.get('/getTasksAssignedEmployees/'+id).then(response=>{
            assigned=response.data;
        })
        axios.get('/getAllEmployees').then(response => {
            $.each(response.data, (key, v) => {
                employees.push(v);
            });
            area.innerHTML="";
            employees.forEach((employee, index) => {
                if(employee.id!=assigned[index].id) {
                    let item = `
<div class="form-check">
  <input class="form-check-input" type="checkbox" id="flexCheck${employee.id}" name="option${employee.id}" value="${employee.id}" >
  <label class="form-check-label">${employee.name}</label>
</div>`;
                    area.innerHTML += item;
                }
                else
                    area.innerHTML += "no unassigned employee";
                }
            )
        });

    }
    function assignEmployee()
    {
        document.getElementById('action-loader').style.display="block";
        document.getElementById('action').style.display="none";
        let Assignments=[];
        employees.forEach((employee, index) => {
            let value=document.getElementById('flexCheck'+employee.id).value;
            if(document.getElementById('flexCheck'+employee.id).checked)
                Assignments.push({"taskId":selectedTaskId,"employeeId":value,"projectId":projectId});
        });
        console.log(Assignments);
        axios.post('/saveAssignment',{
            assignments:Assignments,
        }).then(response=>{
            document.getElementById('notification message').innerText=response.data;
            document.getElementById('alert-pop').classList.add('show');
            document.getElementById('closeModal').click();

            employees.forEach((employee, index) => {
                document.getElementById('flexCheck' + employee.id).checked = 0;
            });

            document.getElementById('action').style.display="block";
            document.getElementById('action-loader').style.display="none";
        })
    }
</script>
