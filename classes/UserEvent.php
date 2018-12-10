<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 02/12/2018
 * Time: 15:29
 */

class UserEvent
{
    private $id_event;
    private $id_user;
    private $valide;

    /**
     * UserEvent constructor.
     * @param $id_event
     * @param $id_user
     * @param $valide
     */
    public function __construct($id_event=null, $id_user=null, $valide=null)
    {
        $this->id_event = $id_event;
        $this->id_user = $id_user;
        $this->valide = $valide;
        $this->bd = ConnexionPDO::getInstance();
    }

    /**
     * @return mixed
     */
    public function getIdEvent()
    {
        return $this->id_event;
    }

    /**
     * @param mixed $id_event
     */
    public function setIdEvent($id_event): void
    {
        $this->id_event = $id_event;
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
    public function getValide()
    {
        return $this->valide;
    }

    /**
     * @param mixed $valide
     */
    public function setValide($valide): void
    {
        $this->valide = $valide;
    }
    public function findParticipations($id_event){
        $requete="
                  select e.nom as nomE,e.date_debut,e.date_fin,e.emplacement,e.places_total,e.places_rest,ue.valide,ue.id_event,ue.id_user,u.login,u.nom as nomU,u.prenom
                  from Evenement e 
                    inner join user_event ue on e.id_event = ue.id_event 
                    inner join Utilisateur u  on ue.id_user = u.id_user 
                    where e.id_event = :id_event";
        $response = $this->bd->prepare($requete);
        $response->execute(
            array(
                'id_event' => $id_event
            )
        );
        return $response->fetchAll(PDO::FETCH_OBJ);
    }
    public function findEventById($id_event)
    {
        $query = " select * from Evenement where id_event=:id_event";
        $response = $this->bd->prepare($query);
        $response->execute(
            array(
                'id_event' => $id_event
            )
        );
        return $response->fetch(PDO::FETCH_OBJ);
    }
    public function findEventsParticipe ($id_user) {
        $requete= "select e.id_event,e.nom,e.date_debut,e.date_fin,e.emplacement,e.places_total,e.places_rest,ue.valide from Evenement e 
                    inner join user_event ue on e.id_event = ue.id_event 
                    inner join Utilisateur u  on ue.id_user = u.id_user 
                    where u.id_user = :id_user";
        $reponse= $this->bd->prepare($requete);
        $reponse->execute( array (
            "id_user"=>$id_user
        ) );

        return $reponse->fetchAll(PDO::FETCH_OBJ);
    }
    public function findEventsAutres($id_user) {
        $requete= "
                    select e.id_event,e.nom,e.date_debut,e.date_fin,e.emplacement,e.places_total,e.places_rest,ue.valide 
                    from Evenement e 
                    inner join user_event ue on e.id_event = ue.id_event 
                    inner join Utilisateur u  on ue.id_user = u.id_user 
                    where u.id_user = :id_user";
        $reponse= $this->bd->prepare($requete);
        $reponse->execute( array (
            'id_user'=>$id_user
        ));

        $events = $reponse->fetchAll(PDO::FETCH_OBJ);

        $tab = array();

        foreach ($events as $event)
        { array_push($tab,$event->id_event);}

        $str=implode(",",$tab);
        $str2="(".$str.")";

        if ($str2!=="()") {
            $requete2= "
                            select * from Evenement 
                            where id_event not in $str2";
        }
        else {
            $requete2= "
                        select * from Evenement 
                        ";
        }
        $reponse2= $this->bd->prepare($requete2);
        $reponse2->execute( );

        return $reponse2->fetchAll(PDO::FETCH_OBJ);


    }
    public function ajouterParticipation($id_event,$id_user) {
        $requete="insert into user_event (id_user,id_event) values (:id_user,:id_event)";

        $reponse= $this->bd->prepare($requete);
        $reponse->execute(array('id_user'=>$id_user,'id_event' => $id_event ));

        return $reponse->fetchAll(PDO::FETCH_OBJ);
    }
    public function findParticipationsToValidate() {
        $requete="
                    select e.nom as nomE,e.date_debut,e.date_fin,e.emplacement,e.places_total,e.places_rest,ue.valide,ue.id_event,ue.id_user,u.login,u.nom as nomU,u.prenom
                    from Evenement e 
                    inner join user_event ue on e.id_event = ue.id_event 
                    inner join Utilisateur u  on ue.id_user = u.id_user 
                    where ue.valide =0";

        $reponse= $this->bd->prepare($requete);
        $reponse->execute( );

        return $reponse->fetchAll(PDO::FETCH_OBJ);

    }
    public function deleteParticipation ($id_event,$id_user) {
        $requete="delete from  user_event where id_event= :id_event  and id_user= :id_user";

        $reponse= $this->bd->prepare($requete);
        $reponse->execute(array ( 'id_event'=>$id_event, 'id_user'=>$id_user) );

        return $reponse->fetch(PDO::FETCH_OBJ);

    }
    public function validerParticipation ($id_event,$id_user,$nbp) {
        $requete="UPDATE user_event SET valide=1 WHERE id_event= :id_event and id_user= :id_user";
        $nbp --;
        $requete2="update evenement set places_rest= :places_rest where id_event= :id_event";
        $reponse= $this->bd->prepare($requete);
        $reponse->execute(array(
            'id_event' => $id_event,
            'id_user'=>$id_user
        ));
        $reponse2= $this->bd->prepare($requete2);
        $reponse2->execute(array(
            'places_rest' => $nbp,
            'id_event' => $id_event
        ));

        return [ $reponse->fetchAll(PDO::FETCH_OBJ), $reponse2->fetchAll(PDO::FETCH_OBJ)];

    }
    public function __destruct()
    {

    }

}