<?php
   extract( $_POST );

   if( !$USERNAME || !$PASSWORD ) {
     fieldsBlank();
     die();
   }
 

   if( isset( $Enter ) ) {

   $userVerified = 0;

  if( $USERNAME == "admin")
  {
    $userVerified = 1;

   if(checkPassword( $PASSWORD ) == true)
      accessGranted( $USERNAME );
   else
      wrongPassword();

   }
   }

  if(!$userVerified)
     accessDenied();

  function checkPassword( $PASSWORD )
  {
    if($PASSWORD == "admin")
       return true;
    else
       return false;
   }

  function accessGranted( $USERNAME )
  {
    echo nl2br(file_get_contents ("text/credentials.txt" ));
   }

  function wrongPassword()
  {
   print("<title>Access denied</title></head>
    <body style = \"font-family: arial;
      Font-size: 1em; color: red\">
    <strong> You entered an invalid password!<br/>Access has been denied.</strong>");
   }


  function accessDenied()
  {
    print("<title>Access denied</title></head>
    <body style = \"font-family: arial;
      Font-size: 1em; color: red\">
    <strong> You were denied any access to this file!<br/></strong>");

   }


  function fieldsBlank()
  {
    print("<title>Access denied</title></head>
    <body style = \"font-family: arial;
      Font-size: 1em; color: red\">
    <strong> Please fill in all form fields!<br/></strong>");

  }


?>