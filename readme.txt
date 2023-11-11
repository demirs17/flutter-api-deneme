GET  /api
tüm postları getirir


POST /login
    username
    password
giriş bilgilerini döndürür

POST /register
    username
    password
    email
yeni kullanıcı kayıt eder


POST /create 
    sahibi *
    resim_yolu
    aciklama       resim_yolu ve aciklama aynı anda boş olamaz
    gizli_mi
post oluşturur

POST /delete
    post_id *
postu siler