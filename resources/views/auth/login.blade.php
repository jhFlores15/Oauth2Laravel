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
    momo
    </div>
  </body>
</html>
<script src="{{ mix('js/app.js') }}"></script> 
<script  type="text/javascript">

  $(document).ready(function() {

   axios.post('/api/auth/login',{
        remember_me: 1,
        password : '220608mixi',
        email :'johflores1510@gmail.com',                
    }).then(response =>{
      console.log(response.data);
      
    }).catch(error =>{
        if(error.response.status==500){
            console.log(error.response);
        }          
    });

     axios.get('/api/user/').then(response => {
        var user= response.data;
        console.log('user');
        console.log(user);
      }).catch(error => {
        console.log(error)
      })
  });

</script>