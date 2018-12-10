<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 02/12/2018
 * Time: 15:28
 */
require 'ConnexionPDO.php';
class Evenement
{
    private $id_event;
    private $nom;
    private $date_debut;
    private $date_fin;
    private $emplacement;
    private $places_total;
    private $places_rest;

    /**
     * Evenement constructor.
     * @param $id_event
     * @param $nom
     * @param $date_debut
     * @param $date_fin
     * @param $emplacement
     * @param $places_total
     * @param $places_rest
     */
    public function __construct($id_event=null, $nom=null, $date_debut=null, $date_fin=null, $emplacement=null, $places_total=null, $places_rest=null)
    {
        $this->id_event = $id_event;
        $this->nom = $nom;
        $this->date_debut = $date_debut;
        $this->date_fin = $date_fin;
        $this->emplacement = $emplacement;
        $this->places_total = $places_total;
        $this->places_rest = $places_rest;
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
    public function getDateDebut()
    {
        return $this->date_debut;
    }

    /**
     * @param mixed $date_debut
     */
    public function setDateDebut($date_debut): void
    {
        $this->date_debut = $date_debut;
    }

    /**
     * @return mixed
     */
    public function getDateFin()
    {
        return $this->date_fin;
    }

    /**
     * @param mixed $date_fin
     */
    public function setDateFin($date_fin): void
    {
        $this->date_fin = $date_fin;
    }

    /**
     * @return mixed
     */
    public function getEmplacement()
    {
        return $this->emplacement;
    }

    /**
     * @param mixed $emplacement
     */
    public function setEmplacement($emplacement): void
    {
        $this->emplacement = $emplacement;
    }

    /**
     * @return mixed
     */
    public function getPlacesTotal()
    {
        return $this->places_total;
    }

    /**
     * @param mixed $places_total
     */
    public function setPlacesTotal($places_total): void
    {
        $this->places_total = $places_total;
    }

    /**
     * @return mixed
     */
    public function getPlacesRest()
    {
        return $this->places_rest;
    }

    /**
     * @param mixed $places_rest
     */
    public function setPlacesRest($places_rest): void
    {
        $this->places_rest = $places_rest;
    }
    public function __destruct()
    {
    }
    public function findAll()
    {
        $query = " select * from Evenement";
        $respone = $this->bd->prepare($query);
        $respone->execute();
        return $respone->fetchAll(PDO::FETCH_OBJ);
    }
     public function addEvent( $nom, $date_debut, $date_fin, $emplacement, $places_total)
    {
        $requete="insert into Evenement (nom,date_debut,date_fin,emplacement,places_total,places_rest) values (:nom,:date_debut,:date_fin,:emplacement,:places_total,:places_total)";

        $respone = $this->bd->prepare($requete);
        $respone->execute(
            array(

                'nom' => $nom,
                'date_debut' => $date_debut,
                'date_fin' => $date_fin,
                'emplacement' => $emplacement,
                'places_total' => $places_total,

            )
        );


    }
    public function findById($id_event)
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
    public function findParticipantsNumber ($id_event)
    {
        $query="select count(*) as NBR from user_event where id_event=:id_event";
        $response = $this->bd->prepare($query);
        $response->execute(
            array(
                'id_event'=>$id_event
            )
        );
        return $response->fetch (PDO::FETCH_OBJ);
    }
    public function updateEvent($id_event,$nom, $date_debut, $date_fin, $emplacement, $places_total,$places_rest)
    {
        $query="UPDATE Evenement SET id_event= :id_event,nom= :nom,date_debut= :date_debut, date_fin= :date_fin,emplacement= :emplacement, places_total= :places_total, places_rest= :places_rest WHERE id_event= :id_event";
        $response = $this->bd->prepare($query);
        $response->execute(
            array(
                'id_event'=>$id_event,
                'nom' => $nom,
                'date_debut' => $date_debut,
                'date_fin' => $date_fin,
                'emplacement' => $emplacement,
                'places_total' => $places_total,
                'places_rest'=>$places_rest
            )
        );
        return $response->fetch (PDO::FETCH_OBJ);

    }
    public function deleteEvent($id_event)
    {
        $query = " delete from Evenement where id_event=:id_event";
        $respone = $this->bd->prepare($query);
        $respone->execute(
            array(
                'id_event' => $id_event
            )
        );
    }
}