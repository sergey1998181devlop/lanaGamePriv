@extends('layouts.app')
@section('content')
<section class="personal_page_wrapper">
    <div class="container-fluid">
        <div class="personal_page">
            <div class="personal_main_content_wrapper" style="margin: 0 auto;">
                <div class="user_profile_form_wrapper">
                    <form method = get class="user_profile">
                        <div class="forma">
                            <div style="text-align: center; margin-bottom: 80px;">
                                <b>Оплата взноса за участие в LANGAME Conference<BR></b>
                                12 мая, Москва, 3000 рублей
                            </div>
                            <div class="form-group" style="display: block;text-align: center;">
                                Введите свой email, указанный при регистрации
                            </div>
                            <div class="form-group required" style="display: block;">
                                <input id="user-name-input" name="email" type="text" value="" placeholder="Email" required="" style="margin: 0 auto;">
                            </div>
                        </div>
                        <? if (isset($_GET['email']) && empty($emails[0]->user_email)):?>
                            <div class="form-group" style="display: block;text-align: center;">
                                Регистрация по указанному email отсутствует. Для уточнения информации напишите на pg@langame.ru<BR><BR>
                            </div>
                        <?endif;?>
                        <button type="submit" class="user_profile_submit" style="margin: 0 auto;">Оплатить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script src="https://widget.cloudpayments.ru/bundles/cloudpayments.js"></script>
<script>
    <? if (!empty($emails[0]->user_email)):?>
        this.pay = function () {
        var widget = new cp.CloudPayments();
            widget.pay('auth',
                {
                    publicId: 'pk_c2c48acc650701a210909a8175196',
                    description: 'Оплата в langame.ru',
                    amount: 1,
                    currency: 'RUB',
                    accountId: '{{$emails[0]->user_email}}',
                    email: '{{$emails[0]->user_email}}',
                    skin: "mini", 
                    data: {
                    }
                },
                {
                onSuccess: function (options) {
                    console.log(options);
                },
                onFail: function (reason, options) {},
                onComplete: function (paymentResult, options) {
                    console.log(options);}
                }
            )
        };
        pay();
    <? endif;?>
</script>
@endsection