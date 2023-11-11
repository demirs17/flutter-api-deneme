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

document.getElementById("submit_button").onclick = async () => {
    var aciklama = document.getElementById("aciklama").value;
    var resimYolu = document.getElementById("resim_yolu").value;
    //alert(aciklama + " - " + resimYolu);
    var data = new FormData();
    data.append('sahibi', Number(window.localStorage.getItem("userId")));
    data.append('resim_yolu', resimYolu);
    data.append('aciklama', aciklama);
    data.append('gizli_mi', '0');
    data.append("token", window.localStorage.getItem("token"));
    var response = await sendPostRequest("http://localhost/flutter-rest-api-deneme/api/create", data);
    console.log(response);
};