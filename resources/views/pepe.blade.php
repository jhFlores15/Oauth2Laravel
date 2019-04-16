<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"; charset=utf-8>
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>fuente de múltiples elementos</title>
  </head>
  <body>
    <div id="app">
    pepe
  {{--   <passport-clients></passport-clients>
    <passport-authorized-clients></passport-authorized-clients>
    <passport-personal-access-tokens></passport-personal-access-tokens> --}}
    </div>
  </body>
</html>
<script src="{{ mix('js/app.js') }}"></script> 
<script  type="text/javascript">

  $(document).ready(function() {

    if(localStorage.getItem('access_token')){
      var config = {
        headers: {
         'Content-Type': 'application/x-www-form-urlencoded' ,
         'Authorization':'Bearer '+ localStorage.getItem('access_token'),
        },
      };
    axios.get('/api/user/',config).
    then(response => {
        var user= response.data;
        console.log('user');
        console.log(user);
      }).catch(error => {
        console.log(error)
      })
    }
  });

</script>