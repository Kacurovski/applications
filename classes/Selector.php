<?php

class Selector
{

    public function selectFromTable($table){

        $pdo = DB::connect();
        
        $sql = "SELECT * FROM {$table}";
  
        $stmt = $pdo->prepare($sql);

        $stmt->execute();
    
        return $stmt->fetchAll();

    }
   
    public function selectRegistrations(){
        $pdo = DB::connect();

        $sql = 'SELECT 
        r.id AS registration_id, 
        m.model_name AS vehicle_model, 
        t.type_name AS vehicle_type, 
        r.chassis_number, 
        r.production_year, 
        r.registration_number, 
        f.fuel_type AS fuel_type, 
        r.registration_to
        FROM registrations r
        INNER JOIN vehicle_models m ON r.vehicle_model_id = m.id
        INNER JOIN vehicle_types t ON r.vehicle_type_id = t.id
        INNER JOIN fuel_types f ON r.fuel_type_id = f.id;';
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute(); 
        return $stmt->fetchAll();
    }

    public function selectSingleRegistration($id)
    {
        $pdo = DB::connect();

        $sql = 'SELECT * FROM registrations WHERE id = :id';
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]); 
        return $stmt->fetch();
    }

    public function getLicensePlate($registrationNumber){

        $pdo = DB::connect();
        
        $sql = 'SELECT 
        m.model_name AS vehicle_model, 
        t.type_name AS vehicle_type, 
        r.chassis_number, 
        r.production_year, 
        r.registration_number, 
        f.fuel_type AS fuel_type, 
        r.registration_to
        FROM registrations r
        INNER JOIN vehicle_models m ON r.vehicle_model_id = m.id
        INNER JOIN vehicle_types t ON r.vehicle_type_id = t.id
        INNER JOIN fuel_types f ON r.fuel_type_id = f.id
        WHERE registration_number = :registration_number'; 
  
        $stmt = $pdo->prepare($sql);

        $stmt->execute([':registration_number' => $registrationNumber]);
    
        return $stmt->fetchAll();
    }

    public function searchCriteria($criteria)
    {
        $pdo = DB::connect();

        $sql = "SELECT 
            r.id AS registration_id,
            m.model_name AS vehicle_model,
            t.type_name AS vehicle_type,
            r.chassis_number,
            r.production_year,
            r.registration_number,
            f.fuel_type AS fuel_type,
            r.registration_to
            FROM registrations r
            INNER JOIN vehicle_models m ON r.vehicle_model_id = m.id
            INNER JOIN vehicle_types t ON r.vehicle_type_id = t.id
            INNER JOIN fuel_types f ON r.fuel_type_id = f.id
            WHERE
            m.model_name LIKE :criteria OR
            r.registration_number LIKE :criteria OR
            r.chassis_number LIKE :criteria";

            $stmt = $pdo->prepare($sql);

            $stmt->execute(['criteria' => $criteria]);

            return $stmt->fetchAll();
    }
}

