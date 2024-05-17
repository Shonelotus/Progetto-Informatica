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

    public function prendiTipologie()
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
    }
    
    public function delete($id)
    {
        $sql = "DELETE FROM prodotto WHERE id=?";
        $statement = $this->conn->prepare($sql);

        if(!$statement) 
            return false;

        $statement->bind_param("i", $id);
        $success = $statement->execute();
        return $success;
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

    public function getProdotti()
    {
        //devo selezionare tutte le informazioni dei vari prodotti percio
        //faccio la select di tutti i miei dati
        //from la tabella prodotto
        //non ho le informazioni della tabella tipologia quindi faccio la join
        //join che va a collegare l'id della tabella prodotto con l'id della tabella appartiene
        //e che collega l'idTipologia della tabella appartiene con l'id della tabella tipologia
        $sql = "
        SELECT p.id, p.nome, p.prezzo, p.quantita, t.id, t.tipo
        FROM prodotto AS p
        JOIN appartiene AS a ON p.id = a.idProdotto
        JOIN tipologia AS t ON a.idTipologia = t.id";

        $statement = $this->conn->prepare($sql);
        $statement->execute();
        $result = $statement->get_result();
        $prodotti = array();

        //fin che ci sono risultati
        while($row = mysqli_fetch_assoc($result)) 
        {
            $prodotti[] = array
            (
                "id" => $row['id'], 
                "nome" => $row['nome'],
                "prezzo" => $row['prezzo'],
                "quantita" => $row['quantita'],
                "tipologia" => $row['tipo']
            );
        }

        return $prodotti;
    }

    public function aggiungiProdotto($nome, $prezzo, $quantita, $tipologiaId)
    {
        $sql = "INSERT INTO prodotto (nome, prezzo, quantita) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            return false; 
        }
        $stmt->bind_param("sdi", $nome, $prezzo, $quantita); 
        $success = $stmt->execute();
        $stmt->close();

        if (!$success) {
            return false; 
        }

        $prodottoId = $this->conn->insert_id;

        $sql = "INSERT INTO appartiene (idProdotto, idTipologia) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            return false; 
        }
        $stmt->bind_param("ii", $prodottoId, $tipologiaId); 
        $success = $stmt->execute();
        $stmt->close();

        return $success;
    }

}
?>
