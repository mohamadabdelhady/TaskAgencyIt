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
<div class="container">
    <h2 class="mt-2">task of : {{$projectName->name}}</h2>
    <div class="row">
        <div class="col-12">


            <div class="" id="all-tasks">
            </div>
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
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('load').style.display="block";
        axios.get('/getTasks')
            .then(response => {
                $.each(response.data, (key, v) => {
                    tasks.push(v);
                });

                tasks.forEach((task,index)=>{
                    let card=`<span class="card me-1 ms-1 d-inline-flex mt-1" style="width: 20rem;">
                <div class="card-body">
                    <h5 class="card-title">${task.name}</h5>
                    <p class="card-text">${abbreviate(task.description,task.id)} <span id="read-more"></span></p>
                    <p>By ${task.createdBy}</p>
                    <div>
                        <a href="" class="me-2" onclick="event.preventDefault(); viewtask(${task.id})" data-bs-toggle="modal" data-bs-target="#viewModal">view</a>
                        <a href="update/${task.id}" class="me-2" >Update</a>
                        <a href="AssignTask/${task.id}" class="me-2" >assign Employee</a>
                        <a href="delete_task/${task.id}" style="color: darkred!important;" class="float-end">Delete</a>
                    </div>
                </div>
            </span>`
                    let area = document.getElementById('all-tasks');
                    area.insertAdjacentHTML('afterend',card);
                })
            });
        document.getElementById('load').style.display="none";
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
</script>
