<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 02/12/2018
 * Time: 15:28
 */
require 'ConnexionPDO.php';
class Utilisateur
{
    private $id_user;
    private $prenom;
    private $nom;
    private $login;
    private $password;
    private $email;
    private $cin;
    private $telephone;
    private $ville;
    private $code_postal;
    private $role;

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role): void
    {
        $this->role = $role;
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->id_user;
    }

    /**
     * @param mixed $id_user
     */
    public function setIdUser($id_user): void
    {
        $this->id_user = $id_user;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom): void
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login): void
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getCin()
    {
        return $this->cin;
    }

    /**
     * @param mixed $cin
     */
    public function setCin($cin): void
    {
        $this->cin = $cin;
    }

    /**
     * @return mixed
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param mixed $telephone
     */
    public function setTelephone($telephone): void
    {
        $this->telephone = $telephone;
    }

    /**
     * @return mixed
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * @param mixed $ville
     */
    public function setVille($ville): void
    {
        $this->ville = $ville;
    }

    /**
     * @return mixed
     */
    public function getCodePostal()
    {
        return $this->code_postal;
    }

    /**
     * @param mixed $code_postal
     */
    public function setCodePostal($code_postal): void
    {
        $this->code_postal = $code_postal;
    }

    /**
     * Utilisateur constructor.
     * @param $id_user
     * @param $prenom
     * @param $nom
     * @param $login
     * @param $password
     * @param $email
     * @param $cin
     * @param $telephone
     * @param $ville
     * @param $code_postal
     */
    public function __construct($id_user=null, $prenom=null, $nom=null, $login=null, $password=null, $email=null, $cin=null, $telephone=null, $ville=null, $code_postal=null, $role=null)
    {
        $this->id_user = $id_user;
        $this->prenom = $prenom;
        $this->nom = $nom;
        $this->login = $login;
        $this->password = $password;
        $this->email = $email;
        $this->cin = $cin;
        $this->telephone = $telephone;
        $this->ville = $ville;
        $this->code_postal = $code_postal;
        $this->role = $role;
        $this->bd = ConnexionPDO::getInstance();
    }

    public function __destruct()
    {

    }

    public function addPersonne( $prenom, $nom, $login, $password, $email, $cin, $telephone, $ville, $code_postal)
    {
        $requete="insert into Utilisateur (prenom,nom,login,password,email,cin,telephone,ville,code_postal,role) values (:prenom,:nom,:login,:password,:email,:cin,:telephone,:ville,:code_postal,'User')";
        var_dump($requete);
        echo"<br>$prenom,$nom,$login,$password,$email,$cin,$telephone,$ville,$code_postal";
        $respone = $this->bd->prepare($requete);
        $respone->execute(
            array(
                'cin' => $cin,
                'prenom' => $prenom,
                'nom' => $nom,
                'login' => $login,
                'password' => $password,
                'email' => $email,
                'telephone' => $telephone,
                'ville' => $ville,
                'code_postal' => $code_postal
            )
        );


    }
    public function updatePersonne( $id_user, $prenom, $nom, $login, $password, $email, $cin, $telephone, $ville, $code_postal,$role)
    {
        $requete="UPDATE Utilisateur SET `prenom`= :prenom,`nom`= :nom,`login`= :login,`password`= :password, `email`= :email, cin= :cin, telephone= :telephone, `ville`= :ville, code_postal= :code_postal, `role`= :role WHERE id_user= :id_user";
        var_dump($requete);
        echo"<br>$id_user,$prenom,$nom,$login,$password,$email,$cin,$telephone,$ville,$code_postal,$role";
        $respone = $this->bd->prepare($requete);
        $respone->execute(
            array(
                'id_user'=>$id_user,
                'cin' => $cin,
                'prenom' => $prenom,
                'nom' => $nom,
                'login' => $login,
                'password' => $password,
                'email' => $email,
                'telephone' => $telephone,
                'ville' => $ville,
                'code_postal' => $code_postal,
                'role' => $role
            )
        );



    }

    public function findAll()
    {
        $query = " select * from utilisateur";
        $respone = $this->bd->prepare($query);
        $respone->execute();
        return $respone->fetchAll(PDO::FETCH_OBJ);
    }

    public function findById($id_user)
    {
        $query = " select * from utilisateur where id_user=:id_user";
        $respone = $this->bd->prepare($query);
        $respone->execute(
            array(
                'id_user' => $id_user
            )
        );
        return $respone->fetch(PDO::FETCH_OBJ);
    }

    public function deletePersonne($id_user)
    {
        $query = " delete from utilisateur where id_user=:id_user";
        $respone = $this->bd->prepare($query);
        $respone->execute(
            array(
                'id_user' => $id_user
            )
        );
    }

    public function connect($login, $password)
    {
        /*
         *
           $query = " select * from user where login=:login and password = :password";
          $respone = $this->bd->prepare($query);
          $respone->execute(
              array(
                  'login'=> $login,
                  'password'=> $password,
              )
          );
          return $respone->fetch(PDO::FETCH_OBJ);*/


        $requete = "select id_user,login,password from Utilisateur ";
        $reponse = $this->bd->prepare($requete);
        $reponse->execute();
        $utilisateurs = $reponse->fetchAll(PDO::FETCH_OBJ);

//exit();
        $test = false;
        foreach ($utilisateurs as $utilisateur) {
            echo $utilisateur->login;

            //exit();
            if ($login == $utilisateur->login) {
                $test = true;


                $requete2 = "select password from Utilisateur where id_user=" . $utilisateur->id_user;
                var_dump($requete2);

                $reponse2 = $this->bd->prepare($requete2);
                $reponse2->execute();
                $password_true = $reponse2->fetch(PDO::FETCH_OBJ);
                echo " password true = <br>";
                var_dump($password_true);

                if ($password_true->password === $password) {
                    $_SESSION['id'] = $utilisateur->id_user;
                    $_SESSION['succes'] = "Bienvenue!";
                    $requete3 = "select role from Utilisateur where id_user=" . $_SESSION['id'];
                    var_dump($requete3);

                    $reponse3 = $this->bd->prepare($requete3);
                    $reponse3->execute();
                    $role_user = $reponse3->fetch(PDO::FETCH_OBJ);
                    echo "<br> role_user = <br>";
                    var_dump($role_user);
                    $_SESSION['role'] = $role_user->role;
                    echo "<br> session role <br>";
                    var_dump($_SESSION['role']);
                    return ["Bienvenue!",$utilisateur->id_user,$role_user->role];
                    header('Location:../index.php');
                    exit();

                } else {
                    $_SESSION['error'] = "Mot de passe incorrect";
                    return["Mot de passe incorrect"];
                    header('Location: ../login.php');
                    exit();
                }

            }
        }
        if ($test === false) {
            $_SESSION['error'] = "Utilisateur introuvable";
            return ["Utilisateur introuvable"];
            header('Location:../login.php');
            exit();

        }
    }
}