<?php
// Affectation d'un niveau à chaque type d'utilisateur
if(isset($_SESSION['type']))
{
    switch($_SESSION['type'])
	{
        case 'admin':
            $_SESSION['level'] = 30;
            break;
        case 'publisher':
            $_SESSION['level'] = 20;
            break;
        case 'user':
            $_SESSION['level'] = 10;
            break;
    }
}
?>