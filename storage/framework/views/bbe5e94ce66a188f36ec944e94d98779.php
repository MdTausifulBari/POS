<div class="container-fluid">
    <div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12">
        <div class="card px-5 py-5">
            <div class="row justify-content-between ">
                <div class="align-items-center col">
                    <h4>Category</h4>
                </div>
                <div class="align-items-center col">
                    <button data-bs-toggle="modal" data-bs-target="#create-modal" class="float-end btn m-0 bg-gradient-primary">Create</button>
                </div>
            </div>
            <hr class="bg-secondary"/>
            <div class="table-responsive">
            <table class="table" id="tableData">
                <thead>
                <tr class="bg-light">
                    <th>No</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody id="tableList">

                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
</div>


<script>

    getList()

    async function getList(){

        try{

            showLoader()
            let res = await axios.get('/category-list', headerToken())
            hideLoader()

// let tableList = document.getElementById('tableList').value; in JQuery is
            let tableList = $("#tableList")

// let tableData = document.getElementById('tableData').value; in JQuery is
            let tableData = $("#tableData")

// To avoid Duplicate in DataTable (JQuery), we need to run these 2 line code
            tableData.DataTable().destroy()
            tableList.empty()

// Index is the Index of the retuned Array of data in res.data['rows']
            res.data['rows'].forEach(function (item, index){
                let row = `<tr>
                            <td>${index+1}</td>
                            <td>${item['name']}</td>
                            <td>
                                <button data-id="${item['id']}" class="btn editBtn btn-sm btn-outline-success">Edit</button>
                                <button data-id="${item['id']}" class="btn deleteBtn btn-sm btn-outline-danger">Delete</button>
                            </td>
                          </tr>`
                tableList.append(row)
            })

            $('.editBtn').on('click', async function() {
                let id = $(this).data('id')
                await FillUpUpdateForm(id)
// document.getElementById("update-modal") == $("#update-modal") [in JQuery]
                $("#update-modal").modal('show')
            })

            $('.deleteBtn').on('click', async function(){
                let id = $(this).data('id')
                $("#delete-modal").modal('show')
                $("#deleteID").val(id)
            })

            new DataTable('#tableData', {
                order:[[0, 'desc']],
                lengthMenu:[5, 10, 15, 20, 30]
            })

        }catch(e){
            unauthorized(e.response.status)
        }

    }

</script>
<?php /**PATH D:\Laravel\Laravel Laptop\0 modules\0 Mega Project (m14 - m18)\POS\resources\views/components/category/category-list.blade.php ENDPATH**/ ?>