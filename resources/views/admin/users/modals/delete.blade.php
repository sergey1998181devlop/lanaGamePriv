<!-- Modal -->
<div class="modal fade" id="deleteUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Подтверждение удаления</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{url('users/delete')}}" method="post">
                {{ csrf_field() }}
                <input type="number" hidden name="userId" id="userId">
            <div class="modal-body">
                    <p>Вы уверены,что хотите удалить <span class="username badge badge-secondary"></span> ?:</p>
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('messages.cancel')}}</button>
                    <button type="submit" class="btn btn-danger">{{__('messages.Delete')}}</button>
            </div>
          </div>
        </div>
      </div>