
{{ form ('session/start') }}
<label for="email">Username/Email</label>
{{textField(["email", "size": "30"]) }}

<label for="password">Password</label>
{{ passwordField(["password", "size" : "30"]) }}

{{ submitButton(['Login']) }}

</form>