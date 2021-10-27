

<!-- Modal -->
<div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{__('messages.RegisterHeader')}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" action="{{ url('users/register') }}">
      <div class="modal-body">
                        @csrf
                        <div class="form-group row">
                            <label for="name_" class="col-md-4 col-form-label text-md-right">{{ __('messages.Name') }}</label>

                            <div class="col-md-6">
                                <input id="name_" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email_" class="col-md-4 col-form-label text-md-right">{{ __('messages.Email') }}</label>

                            <div class="col-md-6">
                                <input id="email_" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone_" class="col-md-4 col-form-label text-md-right">{{ __('messages.phone') }}</label>

                            <div class="col-md-6">
                                <input id="phone_" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="rule_" class="col-md-4 col-form-label text-md-right">Тип</label>
                            <div class="col-md-6">
                                <select name="rules" id="rule_">
                                <option value="0">Нет прав</option>
                                <option value="1" selected>Админ</option>
                                <option value="2">Супер-админ</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password_" class="col-md-4 col-form-label text-md-right">{{ __('messages.Password') }}</label>

                            <div class="col-md-6">
                                <input id="password_" type="password" class="form-control @error('password') is-invalid @enderror @error('password_confirmation') is-invalid @enderror " name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm_" class="col-md-4 col-form-label text-md-right">{{ __('messages.Confirm-Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm_" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('messages.cancel')}}</button>
        <button type="submit" class="btn btn-primary">{{__('messages.Register')}}</button>
      </div>
      </form>
    </div>
  </div>
</div>