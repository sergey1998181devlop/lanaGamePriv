<!-- Modal -->
<div class="modal fade" id="sendMail" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Отправить письмо пользователю</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" id="sendMailForm" action="{{ url('users/sendMail') }}">
      <div class="modal-body">
        @csrf
        <input type="hidden" name="id" id="id_sendMail">
        <div class="form-group row">
            <label for="email_sendMail" class="col-md-12 col-form-label ">{{ __('messages.Email') }}</label>
            <div class="col-md-6">
                <input id="email_sendMail" type="email" class="form-control" name="email" disabled>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-12 col-form-label ">ФИО</label>

            <div class="col-md-6">
                <input name="name"  id="name_sendMail" type="text" class="form-control" disabled>
            </div>
        </div>
        <div class="form-group row">
            <label for="subject" class="col-md-12 col-form-label ">Тема</label>

            <div class="col-md-12">
                <input id="subject" type="text" class="form-control" name="subject" required autofocus>
            </div>
        </div>
        <div class="form-group row">
            <label for="message" class="col-md-12 col-form-label ">Сообщение</label>

            <div class="col-md-12">
                <textarea name="message" id="message" class="form-control" required cols="30" rows="10"></textarea>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
              <p class="mailResult">
                
              </p>
            </div>
        </div>
                    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('messages.cancel')}}</button>
        <button type="submit" class="btn btn-primary">Отправить</button>
      </div>
      </form>
    </div>
  </div>
</div>