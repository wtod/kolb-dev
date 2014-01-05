<?php
session_start();
require('includes/function.php');
/**************************
Index.php
Questionnaire du questionnaire Kolb -> questionnaire kolb


20/12/13
*************************/

/**************************************************************************** 
****************************************************************************

A faire ->  double vérification php/js
            sélecteur question différents
            
            PB : perte session avec SELF
            
            
            travail perso

****************************************************************************
****************************************************************************/

$monTabUsers = $_SESSION['user']; 
testVar($monTabUsers);
testVar($_SESSION['user']['date_naissance']);
$_SESSION['questions'];

$test=date("d/m/Y", $_SESSION['user']['date_naissance']);
testVar($test);

/**************************************************************************** 
Test de soumission de a question et incrémentation du numéro de la question
****************************************************************************/

   $question_number = 1;
    
    $questions = array(
        1 => array("différencier", "essayer", "s'impliquer", "être pratique"),
        2 => array("réceptif", "logique", "méthodique", "impartial"),
        3 => array("ressentir", "faire attention", "réfléchir", "faire"),
        4 => array("accepter", "prendre des risques", "évaluer", "prendre conscience"),
        5 => array("intuitif", "productif", "logique", "interrogateur"),
        6 => array("abstrait", "observateur", "concret", "actif"),
        7 => array("orienté vers le présent", "réflichissant", "orienté vers le futur", "pragmatique"),
        8 => array("partir de son expérience", "observer", "penser", "expérimenter"),
        9  => array("intense", "réservé", "rationel", "responsable")
    ); 
                        
    
   if(isset($_POST['question_submit'])) // test de la soumission de la question en cours
   {
        
        $_SESSION['questions'][$_POST['question_number']] = array($_POST['select-choix-1'],$_POST['select-choix-2'],$_POST['select-choix-3'],$_POST['select-choix-4']);
       
            // testVar($_SESSION['questions'][$numero_question]);
           // print_r($_SESSION['questions'][$numero_question]);
           // print_r($_SESSION['questions']);
      
        if($_POST['question_number'] == 9)
        {
            header('Location:resultat.php');

        }
        $question_number = $_POST['question_number'] + 1; // incrémentation de la question
   }
   else 
   { 
       echo "<p> Vous n'avez pas répondu à la question</p>";
       // charger la page avec la question courante
   }
?>

<?php require_once('includes/header.php'); ?>
        
         <div>
            <div>
              <h1>Évaluation Kolb</h1>            
              <p>Il vous reste encore <?php echo (10 - $question_number); ?> question<?php if($question_number === 9) { echo''; } else { echo 's'; } ?> à remplir, avant de connaitre votre profil d'apprenant</p>
              <div>
                <form name="email-form" method="POST" action="<?php $_SERVER['PHP_SELF']; ?>?etat=2">
                    <input type="hidden" name="question_number" value="<?php echo $question_number;?>" />
                  <div>
                    <div>
                      <div>
                        <label class="label" for="select-choix-1"><?php echo $questions[$question_number][0];  ?></label>
                        <select class="w-select select-score" id="select-choix-1" name="select-choix-1" required="required">
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                        </select>
                      </div>
                    </div>
                    <div>
                      <div>
                        <label class="label" for="select-choix-2"><?php echo $questions[$question_number][1] ; ?></label>
                        <select class="w-select select-score" id="select-choix-2" name="select-choix-2" required="required">
                          <option value="2">2</option>
                          <option value="1">1</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                        </select>
                      </div>
                    </div>
                    <div>
                      <div>
                        <label class="label" for="select-choix-3"><?php echo $questions[$question_number][2]; ?></label>
                        <select class="w-select select-score" id="select-choix-3" name="select-choix-3" required="required">
                          <option value="3">3</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="4">4</option>
                        </select>
                      </div>
                    </div>
                    <div>
                      <div>
                        <label class="label" for="select-choix-4"><?php echo $questions[$question_number][3]; ?></label>
                        <select class="w-select select-score" id="select-choix-4" name="select-choix-4" required="required">
                          <option value="4">4</option>
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <input name="question_submit" type="submit" value="<?php 
                            if($question_number == 9) { 
                                echo "Resultat"; 
                            } 
                            else { 
                                echo "Question ";
                                echo $question_number + 1; 
                            } ?>" />
                </form>
                
              </div>
            </div>
          </div>
        
<?php require_once('includes/footer.php'); ?>