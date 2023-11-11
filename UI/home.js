function sendPostRequest(url, data){
	return new Promise((resolve) => {
		var xhr = new XMLHttpRequest();
		xhr.open('GET', url, true);
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

async function main(){
	var posts = await sendPostRequest("http://localhost/flutter-rest-api-deneme/api", new FormData());
	for(var i = 0;i<posts.length;i++){
		var post = posts[i];
		console.log(post);
		document.querySelector(".posts").innerHTML += `<div class="post">` +
				`<div class="post-sahibi">${post.kullanici_adi}</div>` + 
	    		`<div class="resim-yolu">${post.resim_yolu}</div>` +
	    		//`<div class="resim"><img src="${post.resim_yolu}"></div>` +
	    		`<div class="resim" style="width: 100px;height: 100px;` + 
	    		`background-image: url('${post.resim_yolu}');background-size: contain;background-position: center;background-repeat: no-repeat;">...</div>` +
	    		`<div class="aciklama">${post.aciklama}</div>` +
	    		`<div class="yorumlar">yorumlar</div>` +
    		`</div>` + "<br><br>"
    		
    	document.querySelectorAll(".resim").forEach((elem) => {
			elem.onclick = () => {
				if(getComputedStyle(elem).backgroundSize == "cover"){
					elem.style.backgroundSize = "contain";
				}else{
					elem.style.backgroundSize = "cover";
				}
			}
		});
	}
}
main();


