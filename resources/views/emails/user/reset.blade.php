<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body style="-webkit-text-size-adjust: none;    background-color: #ffffff;    color: #718096;    height: 100%;    line-height: 1.4;    margin: 0;    padding: 0;    width: 100% !important;">

	<table class="wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">
		<tr>
			<td align="center">
				<table class="content" width="100%" cellpadding="0" cellspacing="0" role="presentation">
					<tr>
						<td style="padding: 25px 0;    text-align: center;">
                            <a href="{{ url('/')}}" style="display: inline-block;color: #3d4852;    font-size: 19px;    font-weight: bold;    text-decoration: none;">
                            LanGame
                            </a>
						</td>
					</tr>
					<!-- Email Body -->
					<tr>
						<td class="body" width="100%" cellpadding="0" cellspacing="0">
							<table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
								<!-- Body content -->
								<tr>
                                
									<td class="content-cell">
                                    <h4 class="content-cell">
                                    здравствуйте, Бараа
                                    </h4>
                                    Вы получили это письмо, потому что Вы запросили сброс пароля аккаунта LanGame.
                                    <br>
                                    <div>
                                      <a href="{{$url}}" style="display: block;border: 0;outline: 0;background: #dc0000;border-radius: 14px;    padding: 14px 32px;    font-style: normal;    font-weight: 500;    font-size: 18px;    line-height: 1;    text-align: center;    color: #fff;    cursor: pointer;">Сброс пароля</a>
                                    </div>
										<table class="subcopy" width="100%" cellpadding="0" cellspacing="0" role="presentation">
											<tr>
												<td>Если у вас возникли проблемы с нажатием кнопки «Сбросить пароль», скопируйте и вставьте приведенный ниже URL-адрес в свой веб-браузер : <a href="{{$url}}">{{$url}}</a></td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td>
							<table class="footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
								<tr>
									<td class="content-cell" align="center">© {{ date('Y') }} LanGame. все права защищены</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>

</html>