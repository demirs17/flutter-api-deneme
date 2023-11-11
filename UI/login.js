function sendPostRequest(url, data){
	return new Promise((resolve) => {
		var xhr = new XMLHttpRequest();
		xhr.open('POST', url, true);
		xhr.onreadystatechange = function () {
		    if (xhr.readyState === 4 && xhr.status === 200) {
				console.log(xhr.responseText);
				resolve(JSON.parse(xhr.responseText));
				//callback(JSON.parse(xhr.responseText));
		        //return JSON.parse(xhr.responseText);
		        //document.getElementById("login-status").innerText = response.status;
		        //console.log(xhr.responseText);
		    }
		};
		xhr.send(data);
	});
}
function writeUserDataLS(token, userId, userName){
//    window.localStorage.setItem("userId", userId);
//    window.localStorage.setItem("userName", userName);
    window.localStorage.setItem("token", token);
    readUserDataLS();
}
function readUserDataLS(){
    //var userId = window.localStorage.getItem("userId");
    //var userName = window.localStorage.getItem("userName");
    //if(userId !== null && userName !== null){
    //    document.querySelector(".hesap").innerHTML = "id: " + userId + " <br> kullanici adi: " + userName + "<button onclick='deleteUserDataLS()'>Çıkış Yap</button>";
    //}
    //else{
    //    document.querySelector(".hesap").innerText = "giriş yapılmadı";
    //}
    var token = window.localStorage.getItem("token");
    if(token !== null || token !== undefined){
        document.querySelector(".hesap").innerHTML = "token: " + token;
    }else{
        document.querySelector(".hesap").innerHTML = "giriş yapılmadı";
    }
}
readUserDataLS();
async function deleteUserDataLS(){
    await window.localStorage.removeItem("userId");
    await window.localStorage.removeItem("userName");
    await window.localStorage.removeItem("token");
    readUserDataLS();
}


// LOGİN REQUEST
document.querySelector(".giris-submit").onclick = async () => {
	var data = new FormData();
	data.append('username', document.getElementById("giris_username").value);
	data.append('password', document.getElementById("giris_password").value);
	var response = await sendPostRequest("http://localhost/flutter-rest-api-deneme/api/login", data);
	document.getElementById("login-status").innerText = response.status + "\n" + response.message;
	console.log(response);
        console.log(response.data);
        writeUserDataLS(response.data.token, response.data.id, response.data.kullanici_adi);
};

// REGİSTER REQUEST
document.querySelector(".kayit-submit").onclick = async () => {
	var data = new FormData();
        data.append('username', document.getElementById("kayit_kullanici_adi").value);
	data.append('password', document.getElementById("kayit_sifre").value);
	data.append('email', document.getElementById("kayit_email").value);
	var response = await sendPostRequest("http://localhost/flutter-rest-api-deneme/api/register", data);
	document.getElementById("register-status").innerText = response.status + "\n" + response.message;
	console.log(response);
};