<!DOCTYPE html>
<html>
@include('Include.header')
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
                <button class="btn my-btn mt-2" style="width: 8rem;" onclick="event.preventDefault(); updateProject()">
                    <span id="action">Update</span>
                    <span id="action-loader" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display:none;"></span>
                </button>
                <button type="button"  class="btn btn-secondary" data-bs-dismiss="modal" id="closeModal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="mt-4" >
        @csrf
        <div class="row">
            <div class="col-3">
                <div class="form-floating">
                    <input type="text" class="form-control" id="nameInput" name="name" placeholder="Project name" aria-label="First name" value="{{$project['name']}}">
                    <label for="floatingTextarea">Project name</label>
                </div>
                <div class="form-floating mt-2">
                    <input class="form-control" placeholder="date" id="deadlineInput" name="deadline" type="date" id="deadline" value="{{$project['deadline']}}">
                    <label for="floatingTextarea">Deadline</label>
                </div>
                <div class="form-floating mt-2">
                <select class="form-select" aria-label="Default select example" id="selectStatus">
                    <option value="Open" id="optionOpen">Open</option>
                    <option value="Finished" id="optionFinished">Finished</option>
                    <option value="Aborted" id="optionAborted">Aborted</option>
                </select>
                    <label for="floatingTextarea">Project status</label>
                </div>
            </div>
            <div class="col">
                <div class="form-floating">
                    <textarea id="textInput" type="text" name="description" class="form-control" placeholder="Project description" aria-label="Project description" style="height: 300px" >{{$project['description']}}</textarea>
                    <label for="floatingTextarea">Project description</label>
                </div>
                <button class="btn my-btn mt-2" style="width: 8rem;" onclick="updateProject()">
                    <span id="action">Update</span>
                    <span id="action-loader" class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display:none;"></span>
                </button>
            </div>
        </div>
    </div>

    @include('Include.footer')
</div>
</body>
</html>
<script>

    document.addEventListener("DOMContentLoaded", function() {

        let select = document.getElementById('selectStatus');
        let option;
        for (let i=0; i<select.options.length; i++) {
            let currentOption=select.options[i].value;
            if(currentOption=="{{$project['status']}}")
            {
                console.log(select.options[i].value,"{{$project['status']}}")
                option= select.options[i];
                option.setAttribute('selected', true);
            }
        }
    });

    function updateProject() {
        document.getElementById('action').style.display="none";
        document.getElementById('action-loader').style.display="block";
        axios.post('/updateProject/{{$project['id']}}', {
            name: document.getElementById('nameInput').value,
            deadline: document.getElementById('deadlineInput').value,
            status: document.getElementById('selectStatus').value,
            description: document.getElementById('textInput').value
        }).then(response => {
            document.getElementById('alert-pop').classList.add('show');
            document.getElementById('notification message').innerText=response.data;


            document.getElementById('action').style.display="block";
            document.getElementById('action-loader').style.display="none";
        }).catch(()=> {
            document.getElementById('alert-pop').classList.add('show');
            document.getElementById('notification message').innerText ="Something went wrong and we couldn't execute your request";
        });
    }
</script>
