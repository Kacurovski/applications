<?php

class Registration
{

    private $vehicle_model_id; 
    private $vehicle_type_id;
    private $chassis_number; 
    private $production_year; 
    private $registration_number; 
    private $fuel_type_id;
    private $registration_to;

    public function getVehicleModelId()
    {
        return $this->vehicle_model_id;
    }

    public function getVehicleTypeId()
    {
        return $this->vehicle_type_id;
    }

    public function getVehicleChassisNumber()
    {
        return $this->chassis_number;
    }

    public function getProductionYear()
    {
        return $this->production_year;
    }

    public function getRegistrationNumber()
    {
        return $this->registration_number;
    }

    public function getFuelType()
    {
        return $this->fuel_type_id;
    }

    public function getRegistrationTo()
    {
        return $this->registration_to;
    }

    public function setVehicleModelId($ModelId)
    {
        $this->vehicle_model_id = $ModelId;
    }

    public function setVehicleTypeId($typeId)
    {
        $this->vehicle_type_id = $typeId;
    }

    public function setVehicleChassisNumber($chassisNumber)
    {
        $this->chassis_number = $chassisNumber;
    }

    public function setProductionYear($productionYear)
    {
        $this->production_year = $productionYear;
    }

    public function setRegistrationNumber($registrationNumber)
    {
        $this->registration_number = $registrationNumber;
    }

    public function setFuelType($fuelId)
    {
        $this->fuel_type_id = $fuelId;
    }

    public function setRegistrationTo($registrationTo)
    {
        $this->registration_to = $registrationTo;
    }


    public function store(){
        $pdo = DB::connect();
        
        $selector = new Selector;
    
        $registrationRows = $selector->selectFromTable('registrations', null, $pdo);
        
        $canBeStored = true;
        
        foreach($registrationRows as $row){
            if($this->chassis_number == $row['chassis_number'] || $this->registration_number == $row['registration_number']){
                $canBeStored = false;
                break;
            }
        }
    
        if($canBeStored){
            $sql = "INSERT INTO registrations (vehicle_model_id, vehicle_type_id, chassis_number, production_year, registration_number, fuel_type_id, registration_to) 
            VALUES (:vehicle_model_id, :vehicle_type_id, :chassis_number, :production_year, :registration_number, :fuel_type_id, :registration_to)";
    
            $stmt = $pdo->prepare($sql);
            
            $params = [
                'vehicle_model_id' => $this->vehicle_model_id,
                'vehicle_type_id' => $this->vehicle_type_id,
                'chassis_number' => $this->chassis_number,
                'production_year' => $this->production_year,
                'registration_number' => $this->registration_number,
                'fuel_type_id' => $this->fuel_type_id,
                'registration_to' => $this->registration_to,
            ];
    
            if($stmt->execute($params)){
                return $_SESSION['message'] = '<div class="alert alert-success mt-3 h5 mb-3 w-50 m-auto"><p class="text-center m-0">Registration successfull</p></div>';
            } else {
                return $_SESSION['message'] = '<div class="alert alert-danger mt-3 h5 mb-3 w-50 m-auto"><p class="text-center m-0">Something went wrong</div>';
            }
        } else {
            return $_SESSION['message'] = '<div class="alert alert-danger mt-3 h5 mb-3 w-50 m-auto"><p class="text-center m-0">Chassis number / Registration number already exists</p></div>';
        } 
    } 
    
    public function delete($id){

        $pdo = DB::connect();
        
        $sql = "DELETE FROM registrations WHERE id=:id";
  
        $stmt = $pdo->prepare($sql);

        if($stmt->execute(['id' => $id])){
            return $_SESSION['message'] = '<div class="alert alert-success mt-3 h5 mb-3 w-50 m-auto"><p class="text-center m-0">Registration successfully deleted</p></div>';
        } else {
            return $_SESSION['message'] = '<div class="alert alert-danger mt-3 h5 mb-3 w-50 m-auto"><p class="text-center m-0">Something went wrong.</p></div>';
        };

    }

    public function addVehicleModel($model_name)
    {
        $pdo = DB::connect();
        
        $sql = "INSERT INTO vehicle_models (model_name) VALUES (:model_name)";
  
        $stmt = $pdo->prepare($sql);

        if($stmt->execute(['model_name' => $model_name])){
            return $_SESSION['message'] = '<div class="alert alert-success mt-3 h5 mb-3 w-50 m-auto"><p class="text-center m-0">Vehicle model successfully added</p></div>';
        } else {
            return $_SESSION['message'] = '<div class="alert alert-danger mt-3 h5 mb-3 w-50 m-auto"><p class="text-center m-0">Something went wrong.</p></div>';
        };
    }


    public function updateRegistration($id)
    {
        $pdo = DB::connect();

        $sql = 'UPDATE registrations SET vehicle_model_id = :vehicle_model_id, vehicle_type_id = :vehicle_type_id, chassis_number = :chassis_number, production_year = :production_year, registration_number = :registration_number, fuel_type_id = :fuel_type_id, registration_to = :registration_to WHERE id = :id';

        $stmt = $pdo->prepare($sql);
    
        $params = [
            'id' => $id,
            'vehicle_model_id' => $this->vehicle_model_id,
            'vehicle_type_id' => $this->vehicle_type_id,
            'chassis_number' => $this->chassis_number,
            'production_year' => $this->production_year,
            'registration_number' => $this->registration_number,
            'fuel_type_id' => $this->fuel_type_id,
            'registration_to' => $this->registration_to
        ];

        if($stmt->execute($params)){
            return $_SESSION['message'] = '<div class="alert alert-success mt-3 h5 mb-3 w-50 m-auto"><p class="text-center m-0">Registration successfully updated</p></div>';
        } else {
            return $_SESSION['message'] = '<div class="alert alert-danger mt-3 h5 mb-3 w-50 m-auto"><p class="text-center m-0">Something went wrong</p></div>';
        };
    }

    public function updateRegistrationDate($id)
    {
        $pdo = DB::connect();

        $sql = 'UPDATE registrations SET registration_to = :registration_to WHERE id = :id';

        $stmt = $pdo->prepare($sql);
    
        $params = [
            'id' => $id,
            'registration_to' => $this->registration_to
        ];

        if($stmt->execute($params)){
            return $_SESSION['message'] = '<div class="alert alert-success mt-3 h5 mb-3 w-50 m-auto"><p class="text-center m-0">Registration date successfully updated</p></div>';
        } else {
            return $_SESSION['message'] = '<div class="alert alert-danger mt-3 h5 mb-3 w-50 m-auto"><p class="text-center m-0">Something went wrong</p></div>';
        };
    }
}

?>


