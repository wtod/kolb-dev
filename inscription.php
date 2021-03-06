<?php
session_start();
$_session['user']="";
require_once('includes/function.php');
/**************************
/* Index.php
/* Inscription du questionnaire Kolb -> input information utilisateur
/* 20/12/13
*************************/

/**************************
Plan :
-> Test Post et redirection questionaire
-> Page html formulaire
*************************/
if(isset($_POST["user_nom"]))
{    
    list($jour, $mois, $annee) = explode('/',$_POST['user_date_naissance']);
    
    $_SESSION['user']['name']           = secInput($_POST["user_nom"]);
    $_SESSION['user']['prenom']         = secInput($_POST['user_prenom']);
    $_SESSION['user']['date_naissance'] = mktime(0, 0, 0, $mois, $jour, $annee);
    $_SESSION['user']['formation']      = secInput($_POST['user_formation']);
   
    header("Location:questionaire.php");
}
?>

  <?php require_once('includes/header.php'); ?>

    <div class="row panel">
        <div class="small-10 small-centered large-uncentered columns">
             <h2>&Eacute;valuation Kolb</h2>
        </div>

        <div class="small-10 small-centered large-uncentered columns">
            <p>Les donn&eacute;es sont recueillis uniquement pour nos statistiques.</p>
        </div>
    </div>
    
    <div class="row panel">                 
    <form name="email_form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="email_form" novalidate="novalidate">
        
        <div class="row">
            <div class="large-6 columns">
                <label class="label" for="user_nom">Nom:</label>
                <input class="w-input input" id="input-nom" type="text" placeholder="Entrez votre nom" name="user_nom" required="required" pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$" autofocus="autofocus">
            </div>
            
            <div class="large-6 columns">
                <label class="label" for="user_prenom">Pr&eacute;nom</label>
                <input class="w-input input" id="input-prenom" type="text" placeholder="Entrez votre pr&eacute;nom" name="user_prenom" required="required" pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$">
             </div>
        </div> 
        
        <div class="row">
             <div class="large-12 columns">
                <label class="label" for="user_date_naissance">Date de naissance:</label>
                <input class="w-input input" id="input-date-naissance" type="date" placeholder="jj/mm/aaaa ou jj.mm.aaaa" name="user_date_naissance" required="required">
            </div>
        </div>
        
        <div class="row">
            <div class="large-12 columns">
                <label class="label" for="user_formation">Formation</label>
                <select class="w-select select-field" id="select-formation" name="user_formation" required="required" data-name="formation">
                  <option value="0">Bac</option>
                  <option value="1">Bac +1</option>
                  <option value="2">bac +2</option>
                  <option value="3">bac +3</option>
                  <option value="4">bac +4</option>
                  <option value="5">bac +5</option>
                  <option value="6">Sup&eacute;rieur</option>
                  <option value="7">Autres</option>
                </select>
            </div>
         </div>
         
         <div class="row">
            <div class="small-2 small-centered columns">
                <input type="submit" value="Questionaire" class="button">
            </div>
         </div>
    </form>
    </div>

<?php

$ua = getBrowser();
$yourbrowser = "Your browser: " . $ua['name'] . " " . $ua['version'] . " on " .$ua['platform'] . " reports: <br >" . $ua['userAgent'];  
if($ua['name']=="Internet Explorer" or $ua['name']=="Apple Safari") // test navigateur safari et IE
{
    if(intval($ua['version'])<10) // utilisation de jquery pour les versions de IE inférieur à 10 et safari 
    {
    ?>
    <script>
      $(function() {
  
    // Setup form validation on the #register-form element
    $("#email_form").validate({
    
        // Specify the validation rules
        rules: {
            user_prenom: "required",
            user_date_naissance: "required",
            user_nom: "required",
        },
        
        // Specify the validation error messages
        messages: {
            user_prenom: "Saississez votre prenom",
            user_date_naissance: "Saississez votre date de naissance",
            username: "Saississez votre nom",
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
  });
  </script>
  <?php
  }
}
else { 
?> 
  <script>
  $(document).ready(function() {
        $('#email_form').removeAttr('novalidate');
    });
  </script>
  <?php
}
?>
    
<?php require_once('includes/footer.php'); ?>