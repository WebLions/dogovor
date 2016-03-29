
  <body class="login-img3-body" style="background-image:url(/images/shutterstock_199867346-e1422304464866.jpg)">

    <div class="container">

      <form class="login-form" action="/user/login" method="post">
        <div class="login-wrap">
            <p class="login-img"><img src="/images/img0001.png" style="width:150px;height:100px;"><br>
                <span style="color:#dc143c;font-family:'cooper black';font-size:29px;"><strong>Cars</strong></span><span style="color:#4169e1;font-family:'cooper black';font-size:29px;"><strong>Doc</strong></span>
            </p>
            <?if(isset($_GET['m'])) if($_GET['m']){?>
                    <center><h4>Пароль успешно отправлен!</h4></center>
            <?}?>
            <div class="input-group">
              <span class="input-group-addon"><i class="icon_profile"></i></span>
              <input type="text" name="login" class="form-control" placeholder="Логин" autofocus>
            </div>
            <div class="input-group">
                <span class="input-group-addon"><i class="icon_key_alt"></i></span>
                <input type="password" name="password" class="form-control" placeholder="Пароль">
            </div>
            <button class="btn btn-primary btn-lg btn-block" type="submit">Войти</button>
                <center><a href="/user/reset"> Забыли пароль?</a></center>
            <!--
            <a href = "register" class="btn btn-info btn-lg btn-block">Зарегистрироваться</a>
            -->
        </div>
      </form>

    </div>


  </body>

