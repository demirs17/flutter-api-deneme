<!DOCTYPE html>
<html>
    <head>
    	<title>Instagram</title>
    	<style>
    	   .posts{
    	       display: flex;
    	       flex-direction: column;
    	       gap: 10px;
    	   }
    	   .post{
    	       display: flex;
    	       flex-direction: column;
    	       align-items: center;
    	   }
    	   .post .resim{
    	       overflow: hidden;
    	       max-width: 250px;
    	       max-height: 250px;
    	       background-color: red;
    	       background-size: cover;
    	   }
    	   .konteyner{
        	   background-image: url("https://picsum.photos/100/100");
    	   }
    	</style>
    </head>
    <body>
    	<div class="konteyner"></div>
    	<div class="posts">

    	</div>
    	<script src="UI/home.js"></script>
    </body>
</html>