@extends('admin.master')
@section('admin')
    <div class="container-full">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-8">
                    <div class="box">
                        <div class="box-header">
                            <h4 class="box-title">Sub->SubCategory List</h4>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <div id="complex_header_wrapper"
                                     class="dataTables_wrapper container-fluid dt-bootstrap4">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table id="complex_header"
                                                   class="table table-striped table-bordered display dataTable"
                                                   style="width: 100%;" role="grid"
                                                   aria-describedby="complex_header_info">
                                                <thead>
                                                    <tr role="row">
                                                        <th>Category Parent</th>
                                                        <th>Category Name</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($subSubCategories as $item)
                                                    <tr role="row" class="odd">
                                                        <td>
                                                            @foreach($subCategories as $subCategory)
                                                                @if($subCategory->id == $item->subcategory_id)
                                                                    {{ $subCategory->subcategory_name }}
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td >{{ $item->subsubcategory_name }}</td>
                                                        <td >
                                                            <a href="{{ route('subSubCategory.edit',$item->id) }}" class="btn btn-info mr-2 p-5">Edit</a>
                                                            <a href="{{ route('subSubCategory.delete',$item->id) }}" class="btn btn-danger p-5 delete">Delete</a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- /.col -->

                <!-- Add new category -->
                <div class="col-4">
                    <div class="box">
                        <div class="box-header">
                            <h4 class="box-title">New SubCategory</h4>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col">
                                    <form action="{{ route('subSubCategory.store') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <h5>Category <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select class="form-control" name="category_id" id="categoryId">
                                                            <option value="" disabled selected hidden>Select Category</option>
                                                            @foreach($categories as $item)
                                                                <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('category_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <h5>Sub Category<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select class="form-control" name="subcategory_id" id="subCategoryId">
                                                            <option value="" disabled selected hidden>Select Sub Category</option>
                                                        </select>
                                                        @error('subcategory_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <h5> Sub->SubCategory Name <span class="text-danger">*</span> </h5>
                                                    <div class="controls">
                                                        <input type="text" name="subSubCategory_name" class="form-control">
                                                        @error('subSubCategory_name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="text-xs-right text-right">
                                            <button type="submit" class="btn btn-rounded btn-primary">Add New</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                </div>
                <!-- End add new category -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).on('click', '.delete', function (e){
            e.preventDefault();
            let link = $(this).attr("href");
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success m-2',
                    cancelButton: 'btn btn-danger m-2'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = link;
                    swalWithBootstrapButtons.fire(
                        'Deleted!',
                        'Category has been deleted.',
                        'success'
                    )
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        '',
                        'error'
                    )
                }
            })
        })

        $(document).ready(function (){
           $('#categoryId').on('change', function (){
               let category_id = $(this).val();
               if(category_id){
                   $.ajax({
                       url: "{{ url('/category/sub/ajax') }}/"+category_id,
                       type: "GET",
                       datatype: "json",
                       success: function (data){
                           data = JSON.parse(data)
                           let selectSubCategories = $('#subCategoryId');
                           selectSubCategories.empty();
                           selectSubCategories.append('<option value="" disabled selected hidden>Select Sub Category</option>');
                           $.each(data, function(key, value){
                              selectSubCategories.append('<option value="'+value.id+'">'+value.subcategory_name+'</option>');
                           });
                       }
                   });
               }
           });
        });
    </script>
@endsection
