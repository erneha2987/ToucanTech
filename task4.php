<?php
/*
* This function checks if a user's default email address is valid and has been validated within the last 12 months
*
* @param $userId The ID of the user whose default email address to check
* @return 1 if the email is valid and has been validated within the last 12 months, 
* 2 if the email is empty or invalid, 0 if the email is valid but has not been validated recently, 
* and -1 if the user ID is empty or the default email is empty or invalid
*/
private function checkDefaultEmailValid($userId=null)
{
     // If the user ID is empty, return -1
     if(empty($userId)){
        return -1;
     }

     // Retrieve the default email address for the user ID
     $defaultEmail = $this->getDefaultEmailByUserId($userId);

     // If the default email is empty, set a default email and retrieve it again
     if(empty($defaultEmail))
     {
        $this->set_default_email($userId);
        $defaultEmail = $this->getDefaultEmailByUserId($userId);
     }

     // If the default email is still empty, return -1
     if(empty($defaultEmail))
     {
        return -1;
     }

     // Check if the default email is valid and has been validated within the last 12 months
     // If it is, return 1
     if($defaultEmail['valid']>=1 and ($defaultEmail['validated_on']>(time()-strtotime('-12 months'))))
     {
        return 1;
     }

     // If the default email is empty or invalid, return 2
     if(empty($defaultEmail['email']) or !filter_var($defaultEmail['email'], FILTER_VALIDATE_EMAIL))
     {
        return 2;
     }

     // Check if the email is valid using an external service
     $validationResults = $this->checkIdValid($defaultEmail['email']);

     // If the email is not valid, return 0, otherwise return 1
     if( ! $validationResults ){
        return 0;
     }
     else{
        return 1;
     }
}
