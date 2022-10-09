<?php
$errors = [];

function sanitizePost($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    return htmlspecialchars($data);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // nettoyage et validation des données soumises via le formulaire 
    $name = sanitizePost($_POST['nom']);
    $firstname = sanitizePost($_POST['prenom']);
    $mail = sanitizePost($_POST['courriel']);
    $phone = sanitizePost($_POST['telephone']);
    $subject = sanitizePost($_POST['sujet']);
    $message = sanitizePost($_POST['message']);    
    // gestion des erreurs
    if (!isset($name) || empty($name)) {
        $errors[] = "Le champ  nom est obligatoire.";
    }
    if (!isset($firstname) || empty($firstname)) {
        $errors[] = "Le champ prenom est obligatoire.";
    }
    if (!isset($mail) || empty($mail)|| filter_var($mail, FILTER_VALIDATE_EMAIL) == false) {
        $errors[] = "Le champ mail est obligatoire et contenir une adresse mail valide.";
    }
    if (!isset($phone) || empty($phone)) {
        $errors[] = "Le champ telephone est obligatoire.";
    }
    if (!isset($subject) || empty($subject)) {
        $errors[] = "Le champ sujet est obligatoire.";
    }
    if (!isset($message) || empty($message) ) {
        $errors[] = "Le champ message est obligatoire.";
    }   
    if (empty($errors)) {       
        // affichage si pas d'erreurs lors de la soumision
        echo '<p>Merci ' . $firstname .' '. $name.' de nous avoir contacté à propos de ' . $subject . '.<br>
            Un de nos conseillers vous contactera soit à l’adresse ' .  $mail .' ou par téléphone au '. $phone .' dans les plus brefs délais pour traiter votre demande :<br> 
            ' . $message .'</p>';
        }else{
        // affichage des erreurs
        foreach ($errors as $error) {
            echo $error .'<br>';
        }
    }
}

?>



