<?php

interface iUserDAO
{
    function userRegister($name,$email,$password);
    function deleteUser($userId);
    function updateUserName($userId,$name);
    function logIn($userMail,$userPassword);
    function updatePassword($userId,$newPassword);
    function getUser($userId);
    function getUserIdByEmail($userEmail);
    function getnames();
    function IsUserRegisted($email);
}

include("DAO/userDAO.php");

$userdao = new userDAO;

?>