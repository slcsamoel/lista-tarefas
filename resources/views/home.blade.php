@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card dash-area">
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <x-sidemenu/>

                <div class="container">

                    @if (isset($success))
                        <div class="alert alert-success" role="alert">
                            Um simples alerta success. Olha só!
                        </div>
                    @elseif(isset($error))
                        <div class="alert alert-warning" role="alert">
                            Um simples alerta warning. Olha só!
                        </div>
                    @endif

                    <div class="row" style="padding: 5px;">
                        <div class="col-md-6">
                        </div>

                        <div class="col-md-6">
                            <div class="page-title-menu float-right">
                                    <a href="javascript:void(0)" id="create-new-post" class="btn btn-primary" >Novo</a>
                            </div>
                        </div>
                    </div>

                    <table class="table table-bordered" id="laravel_crud">
                        <thead>
                           <tr>
                              <th>ID</th>
                              <th>Data</th>
                              <th>Descrição</th>
                              <th>Usuario</th>
                              <td colspan="2">Action</td>
                           </tr>
                        </thead>
                        <tbody id="posts-crud">
                           @foreach($tasks as $task)
                           <tr id="task_id_{{ $task->id }}">
                              <td>{{$task->id}} </td>
                              <td>{{ date('d/m/Y', strtotime($task->created_at)) }}</td>
                              <td>{!! $task->descricao !!}</td>
                              <td>{{ $task->user->name }}</td>
                              <td><a href="javascript:void(0)" id="edit-post" data-id="{{ $task->id }}" class="btn btn-info">Edit</a></td>
                              <td>
                               <a href="javascript:void(0)" id="delete-post" data-id="{{ $task->id }}" class="btn btn-danger delete-post">Delete</a></td>
                           </tr>
                           @endforeach
                        </tbody>
                       </table>
                </div>


            </div>
        </div>
    </div>
</div>


  <div class="modal fade" id="ajax-crud-modal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="postCrudModal"></h4>
        </div>
        <div class="modal-body">
          <form id="postForm" name="postForm">
            <input type="hidden" name="task_id" id="task_id">
            <input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->id}}">
            <div class="form-group">
              <label for="inputDescricao" class="col-form-label">Descrição</label>
              <textarea class="form-control" name="descricao" id="descricao" value="" required="" ></textarea>
            </div>
           </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary" id="btn-save" value="create" >Salvar</button>
            </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal-footer">

  </div>

  <script>
    $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

    $('#create-new-post').click(function () {
        $('#btn-save').val("create-post");
        $('#postForm').trigger("reset");
        $('#postCrudModal').html("Add New post");
        $('#ajax-crud-modal').modal('show');
    });

    $('body').on('click', '#edit-post', function () {
      var task_id = $(this).data('id');

      $.get('tasks/'+task_id+'/edit', function (data) {

         $('#postCrudModal').html("Edit post");
          $('#btn-save').val("edit-post");
          $('#ajax-crud-modal').modal('show');
          $('#task_id').val(data.id);
          $('#descricao').val(data.descricao);
      })
   });

    $('body').on('click', '.delete-post', function () {
        var task_id = $(this).data("id");
        confirm("Are You sure want to delete !");

        $.ajax({
            type: "DELETE",
            url: "{{ url('tasks')}}"+'/'+task_id,
            success: function (data) {
                $("#task_id_" + task_id).remove();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
  });

 if ($("#postForm").length > 0) {
      $("#postForm").validate({

     submitHandler: function(form) {
      var actionType = $('#btn-save').val();
      $('#btn-save').html('Sending..');

      $.ajax({
          data: $('#postForm').serialize(),
          url: "{{ route('tasks.store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {

                console.log(data)
                var task = '<tr id="post_id_' + data.id + '"> <td>' + data.id + '</td> <td>' + data.data_criacao + '</td> <td>' +  data.descricao + '</td> <td>' + data.usuario + '</td>';
                task += '<td><a href="javascript:void(0)" id="edit-post" data-id="' + data.id + '" class="btn btn-info">Edit</a></td>';
                task += '<td><a href="javascript:void(0)" id="delete-post" data-id="' + data.id + '" class="btn btn-danger delete-post">Delete</a></td></tr>';


              if (actionType == "create-post") {
                  $('#posts-crud').prepend(task);
              } else {
                  $("#task_id_" + data.id).replaceWith(task);
              }

              $('#postForm').trigger("reset");
              $('#ajax-crud-modal').modal('hide');
              $('#btn-save').html('Save Changes');

          },
          error: function (data) {
              console.log('Error:', data);
              $('#btn-save').html('Save Changes');
          }
      });
    }
  })
}
</script>

@endsection
