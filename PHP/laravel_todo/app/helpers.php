<?php 

function gravatar_url($email)
{
  $email = md5($email);
  return "http://www.gravatar.com/avatar/{$email}?s=40";
}