<form method="post">
	<div class="login loginAdmin">
		<h2>Login<span><a href="javascript:void(0)"></a></span></h2>
		<div>
			<?php 
				if ($pqrs == 1){
					echo "<span class='adverSMSFail'>Invalid User name/Password. Please, try again.</span>";
				}
			?>
		</div>
		
		<div class="clr"></div>
		<form>
			<input name="txtusername" type="text" class="loginImput" placeholder="Username" required/>
			<input name="txtpassword" type="password" class="loginImput" placeholder="Password" required />
		</form>
		<div class="checkBtn">
			<input type="checkbox" class="check"/>&nbsp; Remember me
			<button type="submit" class="loginButton">Sign In</button>
			<div class="clr"></div>
		</div>
	</div>
</form>
<div class="clr"></div>