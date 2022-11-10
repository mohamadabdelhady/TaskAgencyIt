<div class="modal fade" id="submitModal" tabindex="-1" aria-labelledby="submitModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="submitModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closeModal"></button>
            </div>
            <div class="modal-body" id="submitModalBody">

            </div >
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="viewModalBody">

            </div >
            <div class="ms-2" id="viewModalStatus">

            </div>
            <div class="ms-2" id="viewModalDeadline">

            </div>
            <div class="ms-2" id="viewModalBy">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="container">
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
<script>
    let tasks=[];
    let count=0;
    let projects;
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('load').style.display="block";
        axios.get('/getMyTasks')
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
                        <a href="" class="me-2" onclick="event.preventDefault(); viewtask(${task.id})" data-bs-toggle="modal" data-bs-target="#viewModal" id="view">view</a>

                        <a href="/viewMyProject/${task.id}" class="me-2" onclick="event.preventDefault();viewProject(${task.id})" data-bs-toggle="modal" data-bs-target="#viewModal">view parent project</a>
                    </div>
                </div>
            </span>`
                    let area = document.getElementById('all-tasks');
                    area.innerHTML+=card;
                    if(task.status!="Submited")
                    document.getElementById('view').insertAdjacentHTML('afterend',`<a href="/submitTask/${task.id}" class="me-2" onclick="event.preventDefault(); ViewSubmitTask(${task.id})" data-bs-toggle="modal" data-bs-target="#submitModal" id="submit">submit</a>`)

                })
            }).catch(()=> {
            document.getElementById('alert-pop').classList.add('show');
            document.getElementById('notification message').innerText ="Something went wrong and we couldn't execute your request";
        });
        document.getElementById('load').style.display="none";
        if(count=0)
        {
            let area = document.getElementById('no-task');
            area.innerHTML='There is currently no tasks.';
        }

        axios.get('/getMyProjects').then(response=>{
            projects=response.data;
        }).catch(()=> {
            document.getElementById('alert-pop').classList.add('show');
            document.getElementById('notification message').innerText ="Something went wrong and we couldn't execute your request";
        });
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
        document.getElementById('viewModalStatus').innerHTML="status : "+selectedCard.status;
        document.getElementById('viewModalDeadline').innerHTML="deadline : "+selectedCard.deadline;
        document.getElementById('viewModalBy').innerHTML="By "+selectedCard.createdBy;
    }

    function viewProject(id)
    {
        let selectedCard=projects.find(element=>element.id==id);
        document.getElementById('viewModalLabel').innerHTML="name : "+selectedCard.name;
        document.getElementById('viewModalBody').innerHTML="description\n"+selectedCard.description;
        document.getElementById('viewModalStatus').innerHTML="status : "+selectedCard.status;
        document.getElementById('viewModalDeadline').innerHTML="deadline : "+selectedCard.deadline;
        document.getElementById('viewModalBy').innerHTML="By "+selectedCard.createdBy;
    }
    function ViewSubmitTask(id)
    {
        let selectedCard=projects.find(element=>element.id==id);
        document.getElementById('submitModalLabel').innerHTML="name : "+selectedCard.name;
        document.getElementById('submitModalBody').innerHTML=`
                <div class="form-floating">
                    <textarea id="taskContent" type="text" name="report" class="form-control" placeholder="Task report" aria-label="Task description" style="height: 300px" ></textarea>
                    <label for="floatingTextarea">Task report</label>
            </div>
            <button class="btn my-btn mt-2" style="width: 8rem;" onclick="event.preventDefault(); submitTask(${id})">
                    <span id="action">Submit</span>
                    <span id="action-loader" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display:none;"></span>
                </button>
`;
    }

    function submitTask(id)
    {
        document.getElementById('action').style.display="none";
        document.getElementById('action-loader').style.display="block";
        axios.post('/submitTask',{
            report:document.getElementById('taskContent').value,
            taskId:id,
        }).then(response=>{
            document.getElementById('alert-pop').classList.add('show');
            document.getElementById('notification message').innerText=response.data;
            document.getElementById('closeModal').click();


            document.getElementById('action').style.display="block";
            document.getElementById('action-loader').style.display="none";
            document.getElementById('submit').innerHTML="";
        }).catch(()=> {
            document.getElementById('alert-pop').classList.add('show');
            document.getElementById('notification message').innerText ="Something went wrong and we couldn't execute your request";
        });
    }
</script>
