<?php
class gestioneDatabase
{
    public $servername; // indirizzo del server del database
    public $username; // nome utente del database
    public $password; // password del database
    public $dbname; // nome del database

    public $conn;

    public function __construct()
    {
        $this->servername = "localhost";
        $this->username = "root";
        $this->password = "";
        $this->dbname = "noleggio";
    }

    public function connettiDb()
    {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
    }

    /**
     * funzione che mi controlla le credenziali di un user
     */
    public function controlloCredenziali($email, $password)
    {
        $sql = "SELECT user.* FROM user
                JOIN cliente ON user.id = cliente.idUser
                WHERE user.email = ? AND user.password = MD5(?)"; 

        $statement = $this->conn->prepare($sql);
        $statement->bind_param("ss", $email, $password);
        $statement->execute();
        $result = $statement->get_result();
        if ($result->num_rows == 0) 
            return false;
        else if ($result->num_rows == 1) 
            return true;     
    }


    /**
     * prendo l'id di un cliente
     */
    public function takeId($email, $password)
    {
        $sql = "SELECT user.id FROM user
                JOIN cliente ON user.id = cliente.idUser
                WHERE user.email = ? AND user.password = MD5(?)";
        $statement = $this->conn->prepare($sql);
        $statement->bind_param("ss", $email, $password);
        $statement->execute();
        $result = $statement->get_result();
        if ($result->num_rows == 0) 
            return false;
        else if ($result->num_rows == 1) 
        {
            $riga = $result->fetch_assoc(); 
            return $riga['id']; 
        }
    } 
    
    /**
     * prendo l'id di un admin
     */
    public function takeIdAdmin($email, $password)
    {
        $sql = "SELECT user.id FROM user
                JOIN admin ON user.id = admin.idUser
                WHERE user.email = ? AND user.password = MD5(?)";
        $statement = $this->conn->prepare($sql);
        $statement->bind_param("ss", $email, $password);
        $statement->execute();
        $result = $statement->get_result();
        if ($result->num_rows == 0) 
            return false;
        else if ($result->num_rows == 1) 
        {
            $riga = $result->fetch_assoc(); 
            return $riga['id']; 
        }
    } 



    public function aggiungiUtente($nome, $cognome, $email, $password, $numeroTessera, $numeroCartaCredito, $stato, $provincia, $paese, $cap, $via)
    {
        //essendo una is-A devo mettere prima i dati nell'utente 
        //poi nell'indirizzo 
        //e per finire nel cliente con le due chiavi esterne 

        // Inserisco l'utente
        $sql = "INSERT INTO user (nome, cognome, email, password) VALUES (?, ?, ?, MD5(?))";
        $statement = $this->conn->prepare($sql);

        if(!$statement) 
            return false;

        $statement->bind_param("ssss", $nome, $cognome, $email, $password);
        $success = $statement->execute();
        $statement->close();

        if(!$success)
        {
            // C'è stato un errore, quindi ritorno false e non vado avanti
            return false;
        }
        
        // Mi prendo l'id dell'utente appena inserito
        $idUtente = $this->conn->insert_id;
        
        // Inserisco l'indirizzo
        $sql = "INSERT INTO indirizzo (via, cap, paese, provincia, stato) VALUES (?, ?, ?, ?, ?)";
        $statement = $this->conn->prepare($sql);
        if(!$statement)
        {
            // C'è stato un errore, quindi ritorno false e non vado avanti
            return false;
        }
        $statement->bind_param("sssss", $via, $cap, $paese, $provincia, $stato);
        $success = $statement->execute();
        $statement->close();

        if(!$success)
        {
            // C'è stato un errore, quindi ritorno false e non vado avanti
            return false;
        }

        // Mi prendo l'id dell'indirizzo appena inserito
        $idIndirizzo = $this->conn->insert_id;

        // Inserisco il cliente con i riferimenti a user e indirizzo
        $sql = "INSERT INTO cliente (numeroTessera, numeroCarta, idUser, idIndirizzo) VALUES (?, ?, ?, ?)";
        $statement = $this->conn->prepare($sql);
        if(!$statement)
        {
            // C'è stato un errore, quindi ritorno false e non vado avanti
            return false;
        }
        $statement->bind_param("isii", $numeroTessera, $numeroCartaCredito, $idUtente, $idIndirizzo);
        $success = $statement->execute();
        $statement->close();

        return $success;
    }

    /**
     * controllo che sia un admin
     */
    public function checkAdmin($username, $password) 
    {
        $sql = "SELECT user.* FROM user
                JOIN admin ON user.id = admin.idUser
                WHERE user.email = ? AND user.password = MD5(?)";
    
        $statement = $this->conn->prepare($sql);
        $statement->bind_param("ss", $username, $password);
        $statement->execute();
        $result = $statement->get_result();
    
        if ($result->num_rows == 0) {
            return false;
        } else if ($result->num_rows == 1) {
            return true;
        }
    }


    /**
     * funzione che mi permette di aggiungere un marker della mappa al db
     */
    public function addStazione($name, $codice, $numSlot, $lat, $long)
    {
        $sql = "INSERT INTO stazione (nome, codice, numeroSlot, latitude, longitude) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("siidd", $name, $codice, $numSlot, $lat, $long,);

        $success = $stmt->execute();
        $stmt->close();

        return $success;
    }

    /**
     * prendo tutti i markers
     */
    public function getMarkers()
    {
        $sql = "SELECT * FROM stazione";
        $result = $this->conn->query($sql);

        $markers = [];

        while ($row = $result->fetch_assoc()) 
        {
            $markers[] = $row;
        }
        return $markers;
    }

    /**
     * funzione che mi permette di eliminare una stazione
     */
    public function deleteStazione($id) 
    {
        try 
        {
            $stmt = $this->conn->prepare("DELETE FROM stazione WHERE id = ?");
            $stmt->bind_param("i", $id);
            return $stmt->execute();
        } catch (Exception $e) {
            return false;
        }
    }

    public function addBiciDB($gps, $rfid, $longitude, $latitude)
    {
        $sql = "INSERT INTO bicicletta (gps, codiceRFID, latitude, longitude) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iidd", $gps, $rfid, $latitude, $longitude);

        $success = $stmt->execute();
        $stmt->close();

        return $success;
    }

    public function uniqueDataUserDb($numeroTessera)
    {
        $sql = "SELECT COUNT(*) as contatore FROM cliente WHERE numeroTessera = '$numeroTessera'";
        $result = $this->conn->query($sql);

        if($result) 
        {
            $row = $result->fetch_assoc();
            $codiciUguali = $row['contatore'];
            if ($codiciUguali > 0) 
            {
                $risposta = false;
                return $risposta;
            }
            else
            {
                $risposta = true;
                return $risposta;
            }
        } 
        else
            return false;
    }

    public function uniqueDataBiciDb($gps, $rfid)
    {
        $sql = "SELECT COUNT(*) as contatore FROM bicicletta WHERE gps = '$gps' or codiceRFID = '$rfid'";
        $result = $this->conn->query($sql);

        if($result) 
        {
            $row = $result->fetch_assoc();
            $codiciUguali = $row['contatore'];
            if ($codiciUguali > 0) 
            {
                $risposta = false;
                return $risposta;
            }
            else
            {
                $risposta = true;
                return $risposta;
            }
        } 
        else
        {
            return false;
        }
    }
    
    public function getBici()
    {

        $sql = "SELECT b.id, b.gps, b.codiceRFID, b.latitude, b.longitude FROM bicicletta as b";

        $statement = $this->conn->prepare($sql);
        $statement->execute();
        $result = $statement->get_result();
        $prodotti = array();

        //fin che ci sono risultati
        while($row = mysqli_fetch_assoc($result)) 
        {
            $biciclette[] = array
            (
                "id" => $row['id'], 
                "gps" => $row['gps'],
                "rfid" => $row['codiceRFID'],
                "latitudine" => $row['latitude'],
                "longitudine" => $row['longitude']
            );
        }

        return $biciclette;
    }

    public function deleteBici($id)
    {
        $sql = "DELETE FROM bicicletta WHERE id=?";
        $statement = $this->conn->prepare($sql);

        if(!$statement) 
            return false;

        $statement->bind_param("i", $id);
        $success = $statement->execute();
        return $success;
    }

    /*public function prendiTipologie()
    {
        $sql = "SELECT id, tipo FROM tipologia";
        $statement = $this->conn->prepare($sql);
        $statement->execute();
        $result = $statement->get_result();
        $tipologie = array();

        while($row = mysqli_fetch_assoc($result)) 
        {
            $tipologie[] = array
            (
                "id" => $row['id'], 
                "testo" => $row['tipo']
            );        
        }

        return $tipologie;
    }*/
    

}
?>
