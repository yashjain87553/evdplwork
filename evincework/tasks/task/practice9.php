<html>
<head>
<title>Listing 29.3. Working with a Custom Property</title>
</head>

<body bgcolor="#FFFFFF">

<form>

<b>Custom Property:</b>
<br>
<input 
  type="text" 
  name="text_field">

<p>

<input 
  type="button" 
  value="Toggle Custom Property"
  onClick="toggle_custom_property(this.form.text_field)">

</form>

<script language="JavaScript" type="text/javascript">
<!--

document.forms[0].text_field.mandatory = true
document.forms[0].text_field.value = true

function toggle_custom_property(current_field) {
  
  // Get the current value of the mandatory property
  var current_value = current_field.mandatory
  
  // Set the property to the opposite value
  current_field.mandatory = !current_value
  
  // Display the new value in the field
  current_field.value = current_field.mandatory

}

//-->
</script>

</body>
</html>