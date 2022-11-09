
<div class="row">
    <!-- Modal -->
    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="viewModalBody">

                </div>
                <div class="ms-2" id="viewModalBy"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-4">
        <div class="card">
            <div class="card-body">
                <a href="newProject" class=" stretched-link"><p>Create a project <i class="fa fa-plus fa-2x float-end" aria-hidden="true" ></i></p></a>
            </div>
        </div>
    </div>
     <div class="col-xl-9 col-lg-9 col-md-9 col-sm-8">

        <div class="" id="all-projects">

        </div>
         <div class="Loader mt-2" id="load">
             <div class="spinner-border" role="status">
                 <span class="visually-hidden">Loading...</span>
             </div>
         </div>
    </div>
</div>
<script>
    let projects=[];
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('load').style.display="block";
        axios.get('loadAllProjects')
            .then(response => {
                $.each(response.data, (key, v) => {
                    projects.push(v);
                });
                projects.forEach((project,index)=>{
                    let card=`<span class="card me-1 ms-1 d-inline-flex mt-1" style="width: 25rem;">
                <div class="card-body">
                    <h5 class="card-title">${project.name}</h5>
                    <p class="card-text">${abbreviate(project.description)} <a id="more" href="" onclick="event.preventDefault(); viewProject(${project.id})" data-bs-toggle="modal" data-bs-target="#viewModal" style="display:none;">read more</a></p>
                    <p>By ${project.createdBy}</p>
                    <div>
                        <a href="" class="me-2" onclick="event.preventDefault(); viewProject(${project.id})" data-bs-toggle="modal" data-bs-target="#viewModal">view</a>
                        <a href="update/${project.id}" class="me-2" >Update</a>
                        <a href="Create_task/${project.id}" class="me-2" >add task</a>
                        <a href="Assign_task/${project.id}" class="me-2" >assign task</a>
                        <a href="delete_project/${project.id}" style="color: darkred!important;" class="float-end">Delete</a>
                    </div>
                </div>
            </span>`
                    let area = document.getElementById('all-projects');
                    area.insertAdjacentHTML('afterend',card);
                })
            });
        document.getElementById('load').style.display="none";
    });

    function abbreviate(text)
    {
        let count=text.length;

        if(count>150) {
            console.count(count);
            text = text.slice(0,250);
            text+=" .....(click view to read more)";
        }
        return text;
    }

    function viewProject(id)
    {
        let selectedCard=projects.find(element=>element.id==id);
        document.getElementById('viewModalLabel').innerHTML=selectedCard.name;
        document.getElementById('viewModalBody').innerHTML=selectedCard.description;
        document.getElementById('viewModalBy').innerHTML='created by: '+selectedCard.createdBy;
    }
</script>
