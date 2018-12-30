@extends('layouts')
@section('content')
<div class="col-md-6">
    <table class="table table-striped">
        <thead>
            <tr>
                <td>No.</td>
                <td>Title</td>
                <td>Body</td>
                <td colspan="2">Action</td>
            </tr>
        </thead>
        <tbody>
            @php 
                $i = 1;
            @endphp
            @foreach($posts as $post)
            <tr>
                <td>{{$i++}}</td>
                <td>{{$post->title}}</td>
                <td>{{$post->body}}</td>
                <td><a href="{{ route('posts.edit',$post->id)}}" class="btn btn-primary">Edit</a></td>
                <td>
                    <button class="btn btn-danger" onclick="deleteData({{ $post->id }})" type="submit">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
    @section('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        function deleteData(id){
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url : "{{ url('posts')}}" + '/' + id,
                        type : "POST",
                        data : {'_method' : 'DELETE'},
                        success: function(){
                            swal({
                                title: "Success!",
                                text : "Post has been deleted \n Click OK to refresh the page",
                                icon : "success",
                            }).then(function() {
                                location.reload();
                            });
                        },
                        error : function(){
                            swal({
                                title: 'Opps...',
                                text : data.message,
                                type : 'error',
                                timer : '1500'
                            })
                        }
                    })
                } else {
                swal("Your imaginary file is safe!");
                }
            });
        }
    </script>
    @endsection
@endsection
