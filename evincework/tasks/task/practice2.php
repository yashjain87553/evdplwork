<!doctype html>
<html>
<form action="/registration" method="POST">
  <p>
    User name (4 characters minimum, only alphanumeric characters):
    <input data-validation="length alphanumeric" data-validation-length="min4">
  </p>
  <p>
    Year (yyyy-mm-dd):
    <input data-validation="date" data-validation-format="yyyy-mm-dd">
  </p>
  <p>
    Website:
    <input data-validation="url">
  </p>
  <p>
    <input type="submit">
  </p>
</form>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script>
  $.validate({
    lang: 'es'
  });
</script>
</html>