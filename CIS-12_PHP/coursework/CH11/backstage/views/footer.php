<footer class="footer">
	<div class="canister">
		<h4 class="copy">&copy; 2022 Backstage</h4>
	</div>
</footer>

<div id="loginSignupModal" class="modalForm">
	<div class="modalBody">
		<span class="close">&times;</span>

		<div class="loginForm">
			<input type="hidden" id="loginActive" name="loginActive" value="1">
			<h4 id="loginTitle">Login</h4>
			<form>
				<div class="alert" id="loginAlert"></div>
				<fieldset class="form-group">
					<div>
						<label for="email">Email</label>
						<input type="email" class="form-control" id="email" placeholder="Email Address">
					</div>
					<div class="form-group">
						<label for="Password">Password</label>
						<input type="password" class="form-control" id="password" placeholder="Password">
					</div>
				</fieldset>
			</form>
			<div class="modal-footer">
				<a id="toggleLogin">Sign Up</a>
				<button type="button" id="loginSignupButton">Login</button>
			</div>
		</div>
	</div>

</div>
</body>
<script src="../scripts/main.js"></script>
</html>
