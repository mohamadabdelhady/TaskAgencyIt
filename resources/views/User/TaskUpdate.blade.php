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
                    <input type="text" class="form-control" name="name" placeholder="Task name" aria-label="First name">
                    <label for="floatingTextarea">Task name</label>
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
                <button type="button" type="submit" class="btn my-btn" onclick="event.preventDefault(); AssignEmployee();">Assign Task</button>
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
                    <input type="text" class="form-control" id="nameInput" name="name" placeholder="Task name" aria-label="First name" value="{{$Task['name']}}">
                    <label for="floatingTextarea">Task name</label>
                </div>
                <div class="form-floating mt-2">
                    <input class="form-control" placeholder="date" id="deadlineInput" name="deadline" type="date" id="deadline" value="{{$Task['deadline']}}">
                    <label for="floatingTextarea">Deadline</label>
                </div>
                <div class="form-floating mt-2">
                    <select class="form-select" aria-label="Default select example" id="selectStatus">
                        <option value="Open" id="optionOpen">Open</option>
                        <option value="Under development" id="optionUnder development">Under development</option>
                        <option value="Finished" id="optionFinished">Finished</option>
                        <option value="Aborted" id="optionAborted">Aborted</option>
                    </select>
                    <label for="floatingTextarea">Task status</label>
                </div>
            </div>
            <div class="col">
                <div class="form-floating">
                    <textarea id="textInput" type="text" name="description" class="form-control" placeholder="Task description" aria-label="Task description" style="height: 300px" >{{$Task['description']}}</textarea>
                    <label for="floatingTextarea">Task description</label>
                </div>
                <button class="btn my-btn mt-2" style="width: 8rem;" onclick="updateTask()">
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
            if(currentOption=="{{$Task['status']}}")
            {
                console.log(select.options[i].value,"{{$Task['status']}}")
                option= select.options[i];
                option.setAttribute('selected', true);
            }
        }
    });

    function updateTask() {
        document.getElementById('action').style.display="none";
        document.getElementById('action-loader').style.display="block";
        axios.post('/updateTask/{{$Task['id']}}', {
            name: document.getElementById('nameInput').value,
            deadline: document.getElementById('deadlineInput').value,
            status: document.getElementById('selectStatus').value,
            description: document.getElementById('textInput').value
        }).then(response => {
            document.getElementById('alert-pop').classList.add('show');
            document.getElementById('notification message').innerText=response.data;


            document.getElementById('action').style.display="block";
            document.getElementById('action-loader').style.display="none";
        });
    }
</script>
