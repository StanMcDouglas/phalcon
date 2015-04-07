
{{ form ('session/start') }}
<h1>Login</h1>
<div class="formRow">
<label for="email">Username/Email</label>
{{textField(["email", "size": "30"]) }}
</div>
<div class="formRow">
<label for="password">Password</label>
{{ passwordField(["password", "size" : "30"]) }}
</div>
{{ submitButton(['Login', 'class' : 'submit']) }}
<br style="clear:both" />
</form>