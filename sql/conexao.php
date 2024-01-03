<?php
    include 'config.php';

    try {
        $conexao = new PDO(MYSQL_DSN,USER,PASSWORD);
    }catch(PDOException $e){
        print("Erro ao conectar com o banco de dados...<br>".$e->getMessage());
        die();
    }catch(Exception $e){
        print("Erro ...<br>".$e->getMessage());
        die();
    }    
?>