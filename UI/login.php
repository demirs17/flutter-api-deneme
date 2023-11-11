<!doctype html>
<html>
    <head>
        <title>Client</title>
        <style>
            body{
                margin: 0;
                padding: 0;
                display: flex;
                gap: 50px;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
            }
            .giris-form{
                width: 230px;
                display: flex;
                flex-direction: column;
                gap: 20px;
                border: 1px solid black;
                padding: 20px 15px;
                border-radius: 3px;
            }
            .giris-form input[type="text"]{
                padding: 7px 10px;
                border-radius: 3px;
                border: .2px solid black;
            }
            button.giris-submit{
                align-self: center;
                padding: 4px 7px;
                border-radius: 2px;
                border: .5px solid black;
                background-color: #ffffff;
            }
            #login-status{
                text-align: center;
            }
            .kayit-form{
                width: 230px;
                display: flex;
                flex-direction: column;
                gap: 20px;
                border: 1px solid black;
                padding: 20px 15px;
                border-radius: 3px;
            }
            .kayit-form input[type="text"]{
                padding: 7px 10px;
                border-radius: 3px;
                border: .2px solid black;
            }
            button.kayit-submit{
                align-self: center;
                padding: 4px 7px;
                border-radius: 2px;
                border: .5px solid black;
                background-color: #ffffff;
            }
            #register-status{
                text-align: center;
            }
            .hesap{
                width: 300px;
                overflow: auto;
            }
        </style>
    </head>
<body>
    <div class="hesap">
        giris yapilmadi
    </div>
    <div class="giris-form">
        <h4 style="text-align: center;margin-bottom: 5px;">Giriş Yap</h4>
        <input type="text" id="giris_username" placeholder="Kullanıcı Adı"/>
        <input type="text" id="giris_password" placeholder="Şifre"/>
        <button class="giris-submit">Giriş Yap</button>
        <div id="login-status"></div>
    </div>
    <div class="kayit-form">
        <h4 style="text-align: center">Kayıt Ol</h4>
        <input type="text" id="kayit_kullanici_adi" placeholder="Kullanıcı Adı"/>
        <input type="text" id="kayit_sifre" placeholder="Şifre"/>
        <input type="text" id="kayit_email" placeholder="Email"/>
        <button class="kayit-submit">Giriş Yap</button>
        <div id="register-status"></div>
    </div>
    <script type="text/javascript" src="./UI/login.js"></script>
</body>
</html>
