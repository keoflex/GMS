<!--

*** Date modified 12-29-2016
***

GSuite Management System
    Copyright (C) 2017  Michael Keough (Keoflex.com, MichaelKeough.com)

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU Affero General Public License as published
    by the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
-->
<?php

?>
<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Login Form</title>
    
    
    
    
        <link rel="stylesheet" href="./css/style.css">

    
    
    
  </head>

  <body>

    <body>
	<div class="login">
		<div class="login-screen">
			<div  class="app-title">
				<h1 >
				<b style="color:#848484; margin-left:10px; font-size: 30px">[</b>
    <b style="color:#3C78F1; margin-left:10px; font-size: 30px">G</b>
    <b style="color:#F70408; margin-left:10px;font-size: 30px">M</b>
    <b style="color:#f1b500; margin-left:10px;font-size: 30px">S</b>
    <b style="color:#848484; margin-left:10px; font-size: 30px">]</b>
				</h1>
				<h2><span>GSuite Management System</h2>
			</div>
			<form method="post" action="APP/">
                <div class="login-form">
                    <div class="control-group">
                        
                        <input type="text" class="login-field" value="" name="SIGNIN-USERNAME" placeholder="username" id="SIGNING-USERNAME">
                        <label class="login-field-icon fui-user" for="login-name"></label>
                        </div>
        
                        <div class="control-group">
                        <input type="password" class="login-field" value="" name="signin-password" placeholder="password" id="signin-password">
                        <label class="login-field-icon fui-lock" for="login-pass"></label>
                       
                    </div>
    
                    <input type="submit" class="btn btn-primary btn-large btn-block" value="login" />
                  <!--  <a class="login-link" href="#">Lost your password?</a> -->
                </div> 
            </form
		</div>
	</div>
</body>
    
    
    
    
    
  </body>
</html>
